<?php

namespace SecucardConnect\Client;


use Exception;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use SecucardConnect\Product\Common\Model\BaseCollection;
use SecucardConnect\Product\Common\Model\BaseModel;
use SecucardConnect\Product\Common\Model\MainModel;
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
    private $resourceMetadata;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var array
     */
    private $config;

    /**
     * @var LoggerInterface
     */
    private $logger;


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
    private function __construct(ResourceMetadata $resourceMetadata, ClientContext $context)
    {
        $this->resourceMetadata = $resourceMetadata;
        $this->httpClient = $context->httpClient;
        $this->logger = $context->logger;
        $this->config = $context->config;
    }

    /**
     * Function to get list of MainModels
     * @param array $query
     * @return BaseCollection $list
     * @throws Exception
     * @internal param array $options
     */
    public function getList($query = null)
    {
        $params = new RequestParams(RequestOps::GET, $this->resourceMetadata, null, $query);
        $jsonResponse = $this->request($params);

        if ($jsonResponse == false) {
            throw new Exception('Error retrieving data list.');
        }

        $list = new BaseCollection(null, $this->resourceMetadata->resourceClass, null);

        if (is_object($jsonResponse)) {
            $jsonResponse = (array)$jsonResponse;
        }
        if (isset($jsonResponse['count'])) {
            $list->count = $jsonResponse['count'];
        }
        if (isset($jsonResponse['offset'])) {
            $list->offset = $jsonResponse['offset'];
        }
        if (isset($jsonResponse['scroll_id'])) {
            $list->scroll_id = $jsonResponse['scroll_id'];
        }

        if (!isset($jsonResponse['data'])) {
            return $list;
        }

        foreach ($jsonResponse['data'] as $item) {
            $list->_items[] = $this->createResourceInst($item, $this->resourceMetadata->resourceClass);
        }

        // check if we reached end of all items for iteration
        if ($list->count == count($list->_items)) {
            $this->logger->info('reached end of a collection');
            $list->reached_end = true;
        }

        return $list;
    }


    /**
     * Method to get object identified by id
     *
     * @param string $id
     * @return MainModel instance of current class or null
     * @throws \Exception
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

        return $this->createResourceInst($jsonResponse, $this->resourceMetadata->resourceClass);
    }

    /**
     * Function to delete the model identified by id
     *
     * @param BaseModel|MainModel $model
     * @return bool
     * @throws Exception
     * @internal param string $id default null
     */
    public function delete(BaseModel $model)
    {
        if (!$model->isRemovable()) {
            throw new Exception('Trying to delete model ' . get_class($model) . ' but it is not removable');
        }

        $id = $model->getId();
        if (empty($id)) {
            throw new Exception('Cannot delete object with empty primary key value');
        }

        $params = new RequestParams(RequestOps::DELETE, $this->resourceMetadata, $id);
        $jsonResponse = $this->request($params);

        if ($jsonResponse == false) {
            throw new Exception('Error deleting data');
        }

        return $jsonResponse;
    }


    /**
     * Function to save object
     * It can update existing or create new object
     *
     * @param BaseModel|MainModel $model
     * @return bool true on success
     * @throws Exception
     */
    public function save(BaseModel $model)
    {
        if ($this->resourceMetadata->resourceClass != get_class($model)) {
            throw new Exception('Unable save data, data type and service must match.');
        }

        $id = $model->getId();

        // default add new object
        $method = RequestOps::CREATE;

        if (!empty($id)) {
            // update the existing record
            $method = RequestOps::UPDATE;

            if (!$model->isInitialized()) {
                throw new Exception('Trying to save not initialized item');
            }

            if (!$model->isUpdatable()) {
                throw new Exception('Trying to update model ' . $this->resourceMetadata->resourceClass
                    . ' but it is not updatable!');
            }
        }

        $options = array_merge(['auth' => 'oauth', 'json' => $model->getUpdateAttributes()], array());
        $params = new RequestParams($method, $this->resourceMetadata, $id, null, $options);
        $jsonResponse = $this->request($params);

        if ($jsonResponse == false) {
            throw new Exception('Error updating model');
        }

        return $this->createResourceInst($jsonResponse, $this->resourceMetadata->resourceClass);
    }

    private function request(RequestParams $params)
    {
        $rm = $params->resourceMetadata;
        $url = $this->config['base_url'] . $this->config['api_path'] . "/" . $rm->product . '/' . $rm->resource;

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

        if (!empty($params->query)) {
            $options['query'] = $params->query;
        };

        if (!empty($params->jsonData)) {
            $options['json'] = $params->jsonData;
        };

        $req = $this->httpClient->createRequest($params->operation, $url, $options);
        $response = $this->httpClient->send($req);

        if ($response->getStatusCode() == 200) {
            return $response->json();
        }

        return false;
    }

    private function createResourceInst($json, $class)
    {

        if (empty($json)) {
            return null;
        } else {
            $inst = MapperUtil::map($json, $class);
            // set initialized flag for item to true (we expect all data to be available in the server response)
//            $ok = $inst->initValues($json, true);
//            if (!$ok) {
//                throw new Exception('Error initializing model.');
//            }
            return $inst;
        }
    }


}

class RequestOps
{
    const CREATE = 'POST';
    const UPDATE = 'PUT';
    const DELETE = 'DELETE';
    const GET = 'GET';
    const EXECUTE = '???';
    const CUSTOM = 'APP';
}

class RequestParams
{
    /**
     * The operation to perform. See {@link RequestOps} for valid values.
     * @var int
     */
    public $operation;

    /**
     * @var ResourceMetadata
     */
    public $resourceMetadata;

    /**
     * @var string
     */
    public $id;

    /**
     * @var array
     */
    public $query;

    /**
     * @var string
     */
    public $action;

    /**
     * @var string
     */
    public $actionArg;


    /**
     * @var string
     */
    public $jsonData;

    /**
     * @var array
     */
    public $options;

    /**
     * RequestParams constructor.
     * @param string $operation
     * @param ResourceMetadata $resourceMetadata
     * @param string $id
     * @param array $query
     * @param array $options
     */
    public function __construct(
        $operation,
        ResourceMetadata $resourceMetadata,
        $id = null,
        array $query = null,
        array $options = array()
    ) {
        $this->operation = $operation;
        $this->id = $id;
        $this->query = $query;
        $this->options = $options;
        $this->resourceMetadata = $resourceMetadata;
    }


}