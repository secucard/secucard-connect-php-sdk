<?php
/**
 * Api Client class
 */

namespace secucard\client\api;

use secucard\client\oauth\GrantType\ClientCredentials;
use secucard\client\oauth\GrantType\PasswordCredentials;
use secucard\client\oauth\GrantType\RefreshToken;
use secucard\client\oauth\OauthProvider;

use GuzzleHttp\Collection;

/**
 * Secucard Api Client
 * Uses GuzzleHttp client library
 * @author Jakub Elias <j.elias@secupay.ag>
 */
class Client
{
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
     * Api version
     * @var string
     */
    const VERSION = '0.0.1';

    /**
     * Constructor
     * @param array $options - options to correctly initialize Guzzle Client
     */
    public function __construct(array $config)
    {

        // array of base configuration
        $default = array(
            'base_url'=>'https://connect.secucard.com',
            'auth_path'=>'/oauth/token');

        // The following fields are required when creating the client
        $required = array(
            'base_url',
            'auth_path',
            'client_id',
            'client_secret',
            'username',
            'password',
        );

        // Merge in default settings and validate the config
        $config = Collection::fromConfig($config, $default, $required);

        // Create a new Secucard client
        $this->client = new \GuzzleHttp\Client($config->toArray());

        // Ensure that the OauthProvider is attached to the client
        $this->setAuthorization($config);
    }

    /**
     * Public function to set Authorization on client
     * @param Collection $config
     */
    private function setAuthorization(Collection $config)
    {
        // create credentials
        $client_credentials = new ClientCredentials($config['client_id'], $config['client_secret']);
        $password_credentials = new PasswordCredentials($config['username'], $config['password']);

        // create OAuthProvider
        $oauthProvider = new OauthProvider($config['auth_path'], $this->client, $client_credentials, $password_credentials);
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

    /**
     * GET request method
     *
     * @param string $path path to call
     * @param array $options
     * @return $response|false
     */
    public function get($path, $options)
    {
        $response = $this->client->get($path, ['auth'=>'oauth', 'debug'=>true]);
        if (!$response) {
            return false;
        }

        return $response;
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
        $response = $this->client->post($this->protocol . $this->host . $path, ['auth'=>'oauth', 'json'=>$data, 'debug'=>true]);
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
        $response = $this->client->post($this->protocol . $this->host . $path, ['body' => $data ,'debug'=>true]);
        if (!$response) {
            return false;
        }

        return json_decode($response, TRUE);
    }
}