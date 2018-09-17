<?php

namespace SecucardConnect\Client;


use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use Psr\Log\LoggerInterface;
use SecucardConnect\Auth\AuthDeniedException;
use SecucardConnect\Auth\BadAuthException;
use SecucardConnect\Event\EventDispatcher;
use SecucardConnect\Event\EventHandler;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\Error;
use SecucardConnect\Product\Common\Model\MediaResource;
use SecucardConnect\Util\MapperUtil;

/**
 * Base class from which all product resource specific services must derive.<br/>
 * Implements all basic secucard API resource operations. Service subclasses may override for special behaviour (for
 * example to add static args or deny operations) and add resource specific operations. Especially operations using
 * the RequestOps::EXECUTE operation or RequestParams->action should exist as a properly named (like action for
 * instance, "cancel" etc. ) functions in the resource service.
 *
 * @package SecucardConnect\Client
 */
abstract class ProductService
{
    /**
     * @var ResourceMetadata
     */
    protected $resourceMetadata;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var string
     */
    private $actionId;

    /**
     * @param string $product
     * @param string $resource
     * @param ClientContext $context
     *
     * @return mixed
     * @throws Exception
     */
    public static function create($product, $resource, ClientContext $context)
    {
        $rm = new ResourceMetadata($product, $resource);
        $resourceServiceClass = $rm->resourceServiceClass;
        return new $resourceServiceClass($rm, $context);
    }

    /**
     * ProductService constructor.
     * @param ResourceMetadata $resourceMetadata
     * @param ClientContext $context
     */
    protected function __construct(ResourceMetadata $resourceMetadata = null, ClientContext $context = null)
    {
        $this->resourceMetadata = $resourceMetadata;
        if ($context != null) {
            $this->httpClient = $context->httpClient;
            $this->logger = $context->logger;
            $this->config = $context->config;
            $this->storage = $context->storage;
            $this->eventDispatcher = $context->eventDispatcher;
        }
    }

    /**
     * Performs the query for resources according to the given query parameters.
     * @param QueryParams $query The search parameters to apply.
     * @return BaseCollection A collection containing the found items and some meta data. Null if nothing found.
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    public function getList(QueryParams $query = null)
    {
        return $this->getListInternal($query);
    }

    /**
     * Much like getList() but additionally supports fast (forward only) retrieval of large result data amounts by
     * returning the results in batches or pages, like forward scrolling through the whole result.<br/>
     * First specify all wanted search params like count, sort in this call, the returned collection will then contain
     * the first batch along with an unique id to get the next batches by calling getNextBatch().<br/>
     * Actually this API call will create a result set snapshot or search context (server side) from which the results
     * are returned. The mandatory parameter $expireTime specifies how long this snapshot should exist on the server.
     * Since this allocates server resources please choose carefully appropriate times according to your needs,
     * otherwise the server resource monitoring may limit your requests.
     * @param QueryParams $params The query params to apply.
     * @param string $expireTime String specifying the expire time expression of the search context on the server. Valid
     * expression are "{number}{s|m|h}" like "5m" for 5 minutes.
     * @return BaseCollection The first results.
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    public function getScrollableList(QueryParams $params, $expireTime)
    {
        if (empty($expireTime)) {
            throw new ClientError("Missing expire time parameter.");
        }
        return $this->getListInternal($params, $expireTime);
    }

    /**
     * Returns the next batch of results initially requested by getScrollableList() call.
     * @param string $id The id of the result set snapshot to access. Get this id from the collection returned by
     * getScrollableList().
     * @return BaseCollection The collection of result items. The number of returned items may be less as requested
     * by the initial count parameter at the end of the result set. Has count of 0 if no data is available anymore.
     * The total count of items in result is not set here.
     * todo: what happens on expiring
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    public function getNextBatch($id)
    {
        return $this->getListInternal(null, null, $id);
    }

    /**
     * @param QueryParams|null $query
     * @param null $expireTime
     * @param null $scrollId
     *
     * @return BaseCollection
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     * @throws Exception
     */
    private function getListInternal(QueryParams $query = null, $expireTime = null, $scrollId = null)
    {
        $sp = new SearchParams($query, $expireTime, $scrollId);

        $params = new RequestParams(RequestOps::GET, $this->resourceMetadata, null, $sp);

        $jsonResponse = $this->request($params);

        if ($jsonResponse == false) {
            throw new ClientError('Error retrieving data list.');
        }

        $list = new BaseCollection();

        if (is_object($jsonResponse)) {
            $jsonResponse = (array)$jsonResponse;
        }
        if (isset($jsonResponse['count'])) {
            $list->totalCount = $jsonResponse['count'];
        }

        if (isset($jsonResponse['scroll_id'])) {
            $list->scrollId = $jsonResponse['scroll_id'];
        }

        if (!isset($jsonResponse['data'])) {
            return $list;
        }

        $items = $jsonResponse['data'];
        $list->count = count($items);

        foreach ($items as $item) {
            $list->items[] = $this->createResourceInst($item, $this->resourceMetadata->resourceClass);
        }

        if ($list->count == $list->totalCount) {
            $this->logger->debug('reached end of a collection');
        }

        $this->postProcess($list);

        return $list;
    }

    /**
     * Method to get object identified by id
     *
     * @param string $id
     * @return BaseModel
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     * @throws Exception
     */
    public function get($id)
    {
        if (empty($id)) {
            throw new \Exception('cannot load object with empty id');
        }

        $params = new RequestParams(RequestOps::GET, $this->resourceMetadata, $id);
        $jsonResponse = $this->request($params);

        if ($jsonResponse == false) {
            throw new Exception('Error retrieving data');
        }

        $inst = $this->createResourceInst($jsonResponse, $this->resourceMetadata->resourceClass);

        $this->postProcess($inst);

        return $inst;
    }

    /**
     * Function to delete the model identified by id
     *
     * @param BaseModel $model
     * @return bool
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     * @throws Exception
     * @internal param string $id default null
     */
    public function delete(BaseModel $model)
    {
        if (empty($model->id)) {
            throw new Exception('Cannot delete object with empty primary key value');
        }

        $params = new RequestParams(RequestOps::DELETE, $this->resourceMetadata, $model->id);
        $jsonResponse = $this->request($params);

        if ($jsonResponse == false) {
            throw new Exception('Error deleting data');
        }

        $this->postProcess($jsonResponse);

        return $jsonResponse;
    }

    /**
     * Function to save object
     * It can update existing or create new object, if the given object has an id with value null ist will create a
     * new object.
     *
     * @param BaseModel $model The object to save.
     * @return BaseModel The created object, has same type as the given input.
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     * @throws Exception
     */
    public function save(BaseModel $model)
    {
        if ($this->resourceMetadata->resourceClass != get_class($model)) {
            throw new Exception('Unable save data, data type and service must match.');
        }

        // default add new object
        $method = RequestOps::CREATE;

        if (!empty($model->id)) {
            // update the existing record
            $method = RequestOps::UPDATE;
        }

        $params = new RequestParams($method, $this->resourceMetadata, $model->id, null, null, null,
            MapperUtil::jsonEncode($model, $model->jsonFilterProperties(), $model->jsonFilterNullProperties()));
        $jsonResponse = $this->request($params);

        if ($jsonResponse === false) {
            throw new Exception('Error updating model');
        }

        $inst = $this->createResourceInst($jsonResponse, $this->resourceMetadata->resourceClass);

        $this->postProcess($inst);

        return $inst;
    }

    /**
     * @return string
     */
    public function getResourceId()
    {
        return $this->resourceMetadata->resourceId;
    }

    /**
     * Set an ID to submit with the NEXT service call.
     * If provided the server will prevent multiple executions of a service call with the same action ID.
     * This ensures idempotent requests. Multiple service calls will not fail, the server just ignores and returns
     * the same result as returned the first time.
     * But NOTE, this behaviour has a timeout, an assigned ID is only kept for 3 minutes on server, after that treated as
     * new.
     *
     * The given ID is immediately cleared (null) after applied for a service call, even after a failure.
     * @param string $id string Any unique id.
     */
    public function setActionId($id)
    {
        $this->actionId = $id;
    }

    /**
     * @param string $id
     * @param string $action
     * @param null $actionArg
     * @param null $object
     * @param null $class
     *
     * @return bool|mixed|null|string
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    protected function updateWithAction($id, $action, $actionArg = null, $object = null, $class = null)
    {
        return $this->requestAction(RequestOps::UPDATE, $action, $id, $actionArg, $object, $class);
    }

    /**
     * @param string $id
     * @param string $action
     * @param null $actionArg
     * @param null $object
     * @param null $class
     *
     * @return bool|mixed|null|string
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    protected function deleteWithAction($id, $action, $actionArg = null, $object = null, $class = null)
    {
        return $this->requestAction(RequestOps::DELETE, $action, $id, $actionArg, $object, $class);
    }

    /**
     * @param string $id
     * @param string $action
     * @param null $actionArg
     * @param null $object
     * @param null $class
     *
     * @return bool|mixed|null|string
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    protected function execute($id, $action, $actionArg = null, $object = null, $class = null)
    {
        return $this->requestAction(RequestOps::EXECUTE, $action, $id, $actionArg, $object, $class);
    }

    /**
     * @param string $appId
     * @param string $action
     * @param null $object
     * @param null $class
     *
     * @return bool|mixed|null|string
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    protected function executeCustom($appId, $action, $object = null, $class = null)
    {
        return $this->requestAction(RequestOps::EXECUTE, $action, null, null, $object, $class, $appId);
    }

    /**
     * @return array Array with request options to apply. Override in sub classes.<br/>
     * Valid options are: <br/>
     * -
     * -
     */
    protected function getRequestOptions()
    {
        return [];
    }

    /**
     * @param string $op
     * @param string $action
     * @param null $id
     * @param null $actionArg
     * @param null $object
     * @param null $class
     * @param null $appId
     *
     * @return bool|mixed|null|string
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     * @throws Exception
     */
    private function requestAction(
        $op,
        $action,
        $id = null,
        $actionArg = null,
        $object = null,
        $class = null,
        $appId = null
    ) {
        // todo: should property filtering for json also apply here?
        $json = $object == null ? null : MapperUtil::jsonEncode($object);

        $params = new RequestParams($op, $this->resourceMetadata, $id, null, $action, $actionArg, $json);
        if ($appId != null) {
            $params->appId = $appId;
        }
        $json = $this->request($params);
        if ($class != null) {

            if ($class === 'array') {
                $obj = MapperUtil::jsonDecode($json, true);
            } else {
                $obj = MapperUtil::map($json, $class);
            }
            $this->postProcess($obj);
            return $obj;
        }

        $this->postProcess($json);

        return $json;
    }

    /**
     * @param RequestParams $params
     *
     * @return bool|mixed
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     * @throws Exception
     */
    private function request(RequestParams $params)
    {
        /*
         * Build Resource URI
         */
        $rm = $params->resourceMetadata;
        $base = $this->config['base_url'] . $this->config['api_path'] . "/";

        if (!empty($params->appId)) {
            $url = $base . 'General/Apps/' . $params->appId . '/callBackend';
        } else {
            $url = $base . $rm->product . '/' . $rm->resource;
        }

        if (!empty($params->id)) {
            $url .= '/' . $params->id;
        }

        if (!empty($params->action)) {
            $url .= '/' . $params->action;
        }

        if (!empty($params->actionArg)) {
            $url .= '/' . $params->actionArg;
        }

        $options = array_merge(['auth' => 'oauth'], $params->options);

        if (!array_key_exists(\GuzzleHttp\RequestOptions::HEADERS, $options)) {
            $options[\GuzzleHttp\RequestOptions::HEADERS] = [];
        }

        /*
         * Result filtering, sorting & searching
         */
        $p = [];
        if (!empty($params->searchParams->query)) {
            $q = $params->searchParams->query;

            if (!empty($q->count)) {
                $p['count'] = $q->count;
            }

            if (!empty($q->offset)) {
                $p['offset'] = $q->offset;
            }

            if (!empty($q->query)) {
                $p['q'] = $q->query;
            }

            if (!empty($q->fields)) {
                $p['fields'] = implode(',', $q->fields);
            }

            if (!empty($q->sortOrder)) {
                foreach ($q->sortOrder as $key => $value) {
                    $p['sort[' . $key . ']'] = $value;
                }
            }
        }

        if (!empty($params->searchParams->scrollId)) {
            $p['scroll_id'] = $params->searchParams->scrollId;
        }

        if (!empty($params->searchParams->scrollExpire)) {
            $p['scroll_expire'] = $params->searchParams->scrollExpire;
        }

        if (count($p) != 0) {
            $options[\GuzzleHttp\RequestOptions::QUERY] = $p;
        }

        /*
         * JSON Body
         */

        if (!empty($params->jsonData)) {
            $options[\GuzzleHttp\RequestOptions::BODY] = $params->jsonData;
            $options[\GuzzleHttp\RequestOptions::HEADERS]['Content-Type'] = 'application/json';
        }

        /*
         * Idempotence (avoid double execution of the same request)
         */
        if ($this->actionId !== null) {
            $options[\GuzzleHttp\RequestOptions::HEADERS]['X-Action'] = $this->actionId;
            $this->setActionId(null);
        }

        /*
         * Run request
         */
        try {
            $response = $this->httpClient->request($params->operation, $url, $options);
        } catch (Exception $e) {
            throw $this->mapError($e, 'Error sending API request.');
        }

        if ($response->getStatusCode() == 200) {
            return MapperUtil::mapResponse($response);
        }

        return false;
    }

    /**
     * @param Exception $e
     * @param string $msg
     * @return ApiError|AuthError|ClientError|Exception
     */
    protected function mapError(Exception $e, $msg)
    {
        try {
            if ($e instanceof ClientException) {
                // HTTP 4xx

                /*
                 * Examples of $json:
                 * --------------------------------------------------------------------------------
                 * status = "error"
                 * error = "ProductNotAllowedException"
                 * error_details = "The current status of the payment does not allow to capture it"
                 * error_user = "Es ist ein unbekannter Fehler aufgetreten (Code 1003)"
                 * code = 1003
                 * supportId = "f40fa3901afcfa54cd91cb2bd37477ae"
                 * --------------------------------------------------------------------------------
                 * error = "invalid_client",
                 * error_description = "Client credentials were not found in the headers or body"
                 * --------------------------------------------------------------------------------
                 */
                $json = MapperUtil::mapResponse($e->getResponse());

                switch ($e->getCode()) {
                    case 400:
                        // Handle special auth errors
                        $error = new Error(
                            isset($json->error) ? (string)$json->error : '',
                            isset($json->error_description) ? (string)$json->error_description : ''
                        );

                        return new BadAuthException($error, $msg, 400, $e);

                    case 401:
                        // Handle special auth errors
                        $error = new Error(
                            isset($json->error) ? (string)$json->error : '',
                            isset($json->error_description) ? (string)$json->error_description : ''
                        );

                        return new AuthDeniedException($error, $msg);

                    case 403:
                    case 404:
                    default:
                        // Handle other errors with
                        if (isset($json->status) && $json->status == 'error') {
                            // Generic API error
                            return new ApiError(
                                (string)$json->error,
                                (int)$json->code,
                                (string)$json->error_details,
                                (string)$json->error_user,
                                (string)$json->supportId
                            );
                        }
                        break;
                }
            } elseif ($e instanceof ServerException) {
                // HTTP 5xx
                $json = MapperUtil::mapResponse($e->getResponse());
                if (isset($json->status) && $json->status == 'error') {
                    // Try to map to known server error response
                    if (strtolower($json->error) === 'productinternalexception') {
                        // Better map this to an internal error, because it's caused by wrong api usage.
                        return new ClientError((string)$json->error_details, $e);
                    }

                    // Generic API error
                    return new ApiError(
                        (string)$json->error,
                        (int)$json->code,
                        (string)$json->error_details,
                        (string)$json->error_user,
                        (string)$json->supportId
                    );
                }
            }
        } catch (Exception $e) {
            // Ignore parsing errors
        }

        return $e;
    }

    /**
     * Create new or complete a media resource object.
     * @param MediaResource|string $arg The media resource to initialize or a url of a resource.
     * @return MediaResource The initialized media resource instance.
     */
    protected function initMediaResource(&$arg)
    {
        if (is_string($arg)) {
            $mr = new MediaResource();
            $mr->setUrl($arg);
        } else {
            $mr = $arg;
        }

        $mr->setHttpClient($this->httpClient);
        $mr->setStore($this->storage);
        return $mr;
    }

    /**
     * @param array|object $json
     * @param string $class
     *
     * @return mixed|null
     * @throws Exception
     */
    private function createResourceInst($json, $class)
    {
        if (empty($json)) {
            return null;
        }

        return MapperUtil::map($json, $class);
    }

    /**
     * @param mixed $arg
     */
    private function postProcess(&$arg)
    {
        $opts = $this->getRequestOptions();
        if (isset($opts[RequestOptions::RESULT_PROCESSING])) {
            $fn = $opts[RequestOptions::RESULT_PROCESSING];
            if (!is_callable($fn)) {
                throw new \BadFunctionCallException("$fn is not a valid callback for result post processing.");
            }
            $fn($arg);
        }
    }

    /**
     * @param string $id
     * @param EventHandler $handler
     */
    protected function registerEventHandler($id, $handler)
    {
        $this->eventDispatcher->registerEventHandler($id, $handler);
    }
}
