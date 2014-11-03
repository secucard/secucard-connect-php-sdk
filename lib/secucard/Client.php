<?php
/**
 * Api Client class
 */

namespace secucard;

use secucard\client\oauth\GrantType\ClientCredentials;
use secucard\client\oauth\GrantType\PasswordCredentials;
use secucard\client\oauth\GrantType\RefreshToken;
use secucard\client\oauth\OauthProvider;
use secucard\client\log\Logger;
use secucard\client\log\GuzzleSubscriber;
use Psr\Log\LoggerInterface;
use secucard\client\storage\StorageInterface;
use secucard\client\storage\DummyStorage;

use GuzzleHttp\Collection;

/**
 * Secucard Api Client
 * Uses GuzzleHttp client library
 * @author Jakub Elias <j.elias@secupay.ag>
 */
class Client
{

    protected $config;

    /**
     * GuzzleHttp client
     * @var object GuzzleHttp
     */
    protected $client;

    /**
     * Array that maps category names
     * @var array
     */
    protected $category_map;

    /**
     * Logger used for logging
     * @var that implements LoggerInterface
     */
    public $logger;

    public $storage;
    
    protected $callback_push_object;

    /**
     * Api version
     * @var string
     */
    const VERSION = '0.0.1';

    /**
     * Constructor
     * @param array $options - options to correctly initialize Guzzle Client
     * @param $logger - pass here LoggerInterface to use for logging
     * @param $storage - pass here StorageInterface for storing runtime data (like oauth-tokens)
     */
    public function __construct(array $config, $logger = null, $storage = null)
    {
        // array of base configuration
        $default = array(
            'base_url'=>'https://connect.secucard.com',
            'auth_path'=>'/oauth/token',
            'api_path'=>'/api/v2',
            'debug'=>false,
        );

        // The following fields are required when creating the client
        $required = array(
            'base_url',
            'auth_path',
            'api_path',
            'client_id',
            'client_secret'
        );

        // Merge in default settings and validate the config
        $this->config = Collection::fromConfig($config, $default, $required);

        // debug?
        if ($this->config['debug']) {
            // Add HTTP-Requests to log
            $_logger = new GuzzleSubscriber($logger);
        } else {
            $_logger = $logger;
        }

        // Create a new Secucard client
        $this->client = new \GuzzleHttp\Client($this->config->toArray());

        // Create logger
        if ($_logger instanceof GuzzleSubscriber) {
            // add subscriber to guzzle
            $this->logger = $_logger->getLogger();
            $this->client->getEmitter()->attach($_logger);
        } elseif ($_logger instanceof LoggerInterface) {
            // initialize logger with a logger parameter
            $this->logger = $_logger;
        } else {
            // initialize default logger - with logging disabled
            $this->logger = new Logger(null, false);
        }

        // Create storage
        if ($storage instanceof StorageInterface) {
            $this->storage = $storage;
        } else {
            $this->storage = new DummyStorage();
        }

        // Ensure that the OauthProvider is attached to the client
        $this->setAuthorization();
    }

    /**
     * Public function to set Authorization on client
     */
    private function setAuthorization()
    {
        // create credentials
        $client_credentials = new ClientCredentials($this->config['client_id'], $this->config['client_secret']);
        
        // default to client_credentials
        $credentials = $client_credentials;
        
        if (isset($this->config['auth']['type']) && $this->config['auth']['type']  == 'password') {
            $credentials = new PasswordCredentials($this->config['auth']['username'], $this->config['auth']['password']);
        }
        

        // create OAuthProvider
        $oauthProvider = new OauthProvider($this->config['auth_path'], $this->client, $this->storage, $client_credentials, $credentials);
        // assign OAuthProvider to guzzle client
        $this->client->getEmitter()->attach($oauthProvider);
    }

    /**
     * Magic getter for getting the model object inside category
     *
     * uses lazy loading for categories
     * @param string $name
     * @return obj instance of BaseModelCategory
     */
    public function __get($name)
    {
        // if the $name is property of current object
        if (isset($this->$name)) {
            return $this->$name;
        }
        if (isset($this->category_map[strtolower($name)])) {
            return $this->category_map[strtolower($name)];
        }
        $category = null;
        if (file_exists(__DIR__."/../../models/". ucfirst($name) ."Category.php")) {
            // create subcategory if there is a class for it
            $category_class = '\\secucard\\models\\' . $name . 'Category';
            $category = new $category_class($this, $name);
        } else {
            // it is not checked if the category exists
            $category = new \secucard\client\base\BaseModelCategory($this, $name);
        }
        // create category inside category_map
        if ($category) {
            $this->category_map[strtolower($name)] = $category;
            return $category;
        }

        throw new \Exception('Invalid category name: ' . $name);
    }

    protected function buildApiUrl($path) {
        $url = $this->config['base_url'] . $this->config['api_path'] . "/" . $path;
        return $url;
    }


    /**
     * GET request method
     *
     * @param string $path path to call
     * @param array $options
     * @return $response|false
     */
    public function get($path, $options)
    {
        $options = array_merge(['auth'=>'oauth'], $options);
        $response = $this->client->get($this->buildApiUrl($path), $options);
        if (!$response) {
            return false;
        }

        return $response;
    }

    /**
     * DELETE function
     * used to update data for model
     */
    public function delete($path, $data, $options)
    {
        $options = array_merge(['auth'=>'oauth', 'data'=>$data], $options);
        $response = $this->client->delete($this->buildApiUrl($path), $options);
        if (!$response) {
            return false;
        }

        return json_decode($response, TRUE);
    }

    /**
     * POST json request method
     *
     * @param string $path path to call
     * @param mixed $data (data to post)
     * @param array $options
     * @return $response|false
     */
    public function post($path, $data, $options)
    {
        $options = array_merge(['auth'=>'oauth', 'json'=>$data], $options);
        $response = $this->client->post($this->buildApiUrl($path), $options);
        if (!$response) {
            return false;
        }

        return $response;
    }

    /**
     * POST url_encoded request method
     *
     * @param string $path path to call
     * @param mixed $data
     * @param array $options
     * @return $response|false
     */
    public function postUrlEncoded($path, $data, $options)
    {
        $options = array_merge(['auth'=>'oauth', 'body'=>$data], $options);
        $response = $this->client->post($this->buildApiUrl($path), $options);
        if (!$response) {
            return false;
        }

        return json_decode($response, TRUE);
    }

    /**
     * PUT function
     * used to update data for model
     */
    public function put($path, $data, $options)
    {
        $options = array_merge(['auth'=>'oauth', 'body'=>$data], $options);
        $response = $this->client->put($this->buildApiUrl($path), $options);
        if (!$response) {
            return false;
        }

        return json_decode($response, TRUE);
    }
    
    public function registerCallbackObject($callable) {
        $this->callback_push_object = $callable;
    }
    
    public function processPush($get = null, $post = null, $postRaw = null) {
        
        // GET
        if (!$get) {
            $get = $_GET;
        }

        // POST
        if (!$post) {
            $post = $_POST;
        }
        
        // POST-RAW
        if (!$postRaw) {
            $postRaw = @file_get_contents('php://input');
        }
        
        if ($this->callback_push_object) {
            
            /* TODO: Implement creation of object / get loaded object for object/id */
            $obj = new models\Services\Identresults($this);
            
            // Call callback
            call_user_func($this->callback_push_object, $obj);
        }
    }
    
    public function factory($object) {
        
        $product = 'secucard\models\\'.$object;
        if(class_exists($product))
        {
            return new $product($this);
        }
        else {
            throw new \Exception("Invalid product type given.");
        }
        
    }

}