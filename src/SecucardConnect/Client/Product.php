<?php
/**
 * Base Model Category class file
 */

namespace SecucardConnect\Client;

use Exception;

/**
 * Class to allow to use secucard-client->product->service->method design pattern
 *
 */
class Product
{
    /**
     * @var ClientContext
     */
    protected $clientContext;

    /**
     * The name for current category
     * @var string
     */
    protected $name;

    /**
     * Associative array for service to class mapping
     * @var array
     */
    protected $serviceMap;


    /**
     * Constructor
     * @param $name
     * @param ClientContext $context
     */
    public function __construct($name, ClientContext $context)
    {
        $this->name = $name;
        $this->clientContext = $context;
    }

    /**
     * Magic getter for getting the model object inside category uses lazy loading for modules
     * Function can become more complex if we allow the category names to begin with lowercase letter
     *
     * @param string $name
     * @return ProductService The instance of the service class for resource.
     * @throws \Exception
     */
    public function __get($name)
    {
        $resource = ucfirst(strtolower($name));

        if (isset($this->serviceMap[$resource])) {
            return $this->serviceMap[$resource];
        }


        // create model inside model_map
        $service = ProductService::create($this->name, $resource, $this->clientContext);
        if ($service) {
            $this->serviceMap[$resource] = $service;
            return $service;
        }

        throw new Exception('Invalid service name ' . $name . ' for product ' . $this->name);
    }
}