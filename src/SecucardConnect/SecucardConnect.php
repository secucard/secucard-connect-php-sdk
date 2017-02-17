<?php
/**
 * Api Client class
 */

namespace SecucardConnect;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use SecucardConnect\Auth\GrantTypeInterface;
use SecucardConnect\Auth\OauthProvider;
use SecucardConnect\Client\ClientContext;
use SecucardConnect\Client\DummyStorage;
use SecucardConnect\Client\Product;
use SecucardConnect\Client\ResourceMetadata;
use SecucardConnect\Client\StorageInterface;
use SecucardConnect\Event\EventDispatcher;
use SecucardConnect\Util\GuzzleLogger;
use SecucardConnect\Util\Logger;

/**
 * Secucard Api Client
 * Uses GuzzleHttp client library
 * @author Jakub Elias <j.elias@secupay.ag>
 * @property Product payment
 * @property Product service
 */
final class SecucardConnect
{
    /**
     * @var OAuthProvider
     */
    private $oauthProvider;

    /**
     * Configuration
     * @var array
     */
    protected $config;

    /**
     * GuzzleHttp client
     * @var Client
     */
    protected $httpClient;

    /**
     * @var ClientContext
     */
    private $clientContext;

    /**
     * Array that maps category names
     * @var array
     */
    protected $productMap;

    /**
     * Logger used for logging
     * @var \Psr\Log\LoggerInterface
     */
    public $logger;

    /**
     * Storage used to store authorization
     * @var \SecucardConnect\Client\StorageInterface
     */
    public $storage;

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * SKD version
     * @var string
     */
    const VERSION = '1.1.2';

    const HTTP_STATUS_CODE_OK = 200;

    /**
     * Constructor
     * @param array $config Options to correctly initialize the client.
     * @param LoggerInterface $logger Pass here LoggerInterface to use for logging
     * @param StorageInterface $dataStorage Pass here StorageInterface for storing any runtime data (like images)
     * @param StorageInterface $tokenStorage Pass here StorageInterface for storing authentication data like auth.
     * tokens.
     * @param GrantTypeInterface $credentials The credentials to use when operations need authorization
     */
    public function __construct(
        array $config,
        LoggerInterface $logger = null,
        StorageInterface $dataStorage = null,
        StorageInterface $tokenStorage,
        GrantTypeInterface $credentials
    )
    {
        // array of base configuration
        $default = array(
            'base_url' => 'https://connect.secucard.com',
            'auth_path' => '/oauth/token',
            'api_path' => '/api/v2',
            'debug' => false,
            'auth' => null
        );

        // The following fields are required when creating the client
        $required = array(
            'base_url',
            'auth_path',
            'api_path',
        );

        // Merge in default settings and validate the config
        $this->config = $this->mergeCfg($config, $default, $required);

        // initialize default logger with logging disabled if not provided
        $this->logger = $logger == null ? new Logger(null, false) : $logger;

        $this->logger->debug('Using config: ' . print_r($this->config, true));

        // Create the default common storage if necessary
        if ($dataStorage == null) {
            $this->storage = new DummyStorage();
        }

        // create OAuthProvider, pass the separate token storage
        if ($credentials != null) {
            $this->oauthProvider = new OauthProvider($this->config['auth_path'], $tokenStorage, $credentials);
            $this->oauthProvider->setLogger($this->logger);
        }

        $this->initHttpClient();

        if ($this->oauthProvider != null) {
            $this->oauthProvider->setHttpClient($this->httpClient);
        }

        $this->eventDispatcher = new EventDispatcher();

        $c = new ClientContext();
        $c->httpClient = $this->httpClient;
        $c->storage = $this->storage;
        $c->config = $this->config;
        $c->logger = $this->logger;
        $c->eventDispatcher = $this->eventDispatcher;
        $this->clientContext = $c;
    }


    private static function mergeCfg(array $config = [], array $defaults = [], array $required = [])
    {
        $data = $config + $defaults;

        if ($missing = array_diff($required, array_keys($data))) {
            throw new \InvalidArgumentException('Config is missing the following keys: ' . implode(', ', $missing));
        }

        return $data;
    }


    /**
     * Performs authentication using the given parameter and the credentials passed in this instance
     * constructor. The returned result depends on the credentials type and parameter content. <br/>
     * Note: For credentials other then Auth\DeviceCredentials calling this method is fully optional - since no user
     * interaction is required the auth is done automatically when needed (usually when invoking the first
     * service call). However one may call in advance (before service calls) to make sure the authentication is working
     * correctly.
     * @param array $param Optional argument array, may contain a 'devicecode' entry.
     * @return bool|Auth\AuthCodes For instances of Auth\DeviceCredentials an instance of
     * Auth\AuthCodes is returned when passing no parameter, when passing 'devicecode' key either true or false
     * if the authentication is still pending. In the pending case just repeat the call until true.<br/>
     * For other credential types true is returned.
     * @throws \Exception If an error happens during the process. Inspect the exception type to get further details
     * about the cause.
     * @see \SecucardConnect\Client\AuthError
     */
    public function authenticate(array $param = null)
    {
        $result = $this->oauthProvider->getAccessToken(is_array($param) ? $param['devicecode'] : null);
        if (is_string($result)) {
            return true;
        } else {
            return $result;
        }
    }

    /**
     * Return the current access token for external browser usage.
     * Authentication takes place if no authentication was done before, so if you are using Auth\DeviceCredentials
     * make sure to call authenticate() before this to go trough the required initial auth steps!
     *
     * NOTE: Usually when using this SDK it is never required to know the token since all auth aspects are handled
     * inside this SDK. But some in cases obtaining the token via this method may be useful for example when generating
     * JS code for using the secucard connect JS SDK and providing the token for it.
     * @return null|string Null if no token is used, the token data as JSON like: {"access_token":"abc", "expires_in":500}.
     * Expire time is in s.
     *
     */
    public function accessTokenForJS()
    {
        if ($this->oauthProvider == null) {
            return null;
        }

        return $this->oauthProvider->getAccessToken(null, true);
    }


    /**
     * Magic getter for getting the product object.
     *
     * @param string $name
     * @return \SecucardConnect\Client\Product
     * @throws \Exception
     */
    public function __get($name)
    {
        $prod = ucfirst(strtolower($name));

        if (isset($this->productMap[$prod])) {
            return $this->productMap[$prod];
        }

        $rm = new ResourceMetadata($name);
        $prodInst = null;
        $prodClass = $rm->productClass;
        if (class_exists($prodClass)) {
            // try to create product impl. if there is a class for it
            $prodInst = new $prodClass($prod, $this->clientContext);
        } else {
            // use default
            $prodInst = new Product($prod, $this->clientContext);
        }

        // create category inside category_map
        $this->productMap[$prod] = $prodInst;
        return $prodInst;
    }

    /**
     *
     * @param $eventData string A string containing the event JSON.
     * @return void
     * @throws \Exception If an error happens during processing.
     */
    public function handleEvent($eventData)
    {
        $this->logger->debug('Received Push with data: ' . $eventData);
        $this->eventDispatcher->dispatch($eventData);
    }

    private function initHttpClient()
    {
        $stack = HandlerStack::create();
        $options = ['base_uri' => $this->config['base_url'], 'handler' => $stack, 'auth' => null];

        if (isset($this->config['debug']) && $this->config['debug'] === true) {
            $options['debug'] = true;
            // Add HTTP-Requests to log
            $stack->push(new GuzzleLogger($this->logger));
        }

        if ($this->oauthProvider != null) {
            // assign OAuthProvider to guzzle client  to intercept requests and adding auth tokens
            $stack->push(function (callable $handler) {
                return function (RequestInterface $request, array $options) use ($handler) {
                    $request = $this->oauthProvider->appyAuthorization($request, $options);
                    return $handler($request, $options);
                };
            });
        }

        $this->httpClient = new Client($options);
    }


}
