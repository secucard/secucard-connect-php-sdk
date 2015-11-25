<?php
/**
 * Base Model Category class file
 */

namespace SecucardConnect\Product\Common\Model;
use secucard\client\base\instance;
use secucard\client\base\secucard;

/**
 * Base Model Category class to allow to use $client->category->model->method design pattern
 *
 * @author Jakub Elias <j.elias@secupay.ag>
 */
class BaseModelCategory
{
    /**
     * client that will be used for models
     * @var secucard\client\api\Client
     */
    protected $client;

    /**
     * The name for current category
     * @var string
     */
    protected $category_name;

    /**
     * Associative array for model_name to class mapping
     * @var array
     */
    protected $model_map;

    /**
     * Constructor
     */
    public function __construct(\SecucardConnect\SecucardConnect &$client, $category_name)
    {
        $this->client = $client;
        $this->category_name = $category_name;
    }

    /**
     * Magic getter for getting the model object inside category uses lazy loading for modules
     * Function can become more complex if we allow the category names to begin with lowercase letter
     *
     * @param string $name
     * @return instance of class for model
     */
    public function __get($name)
    {
        if (isset($this->model_map[strtolower($name)])) {
            return $this->model_map[strtolower($name)];
        }
        $model_class = '\\secucard\\models\\' . ucfirst($this->category_name) . '\\' . ucfirst($name);
        // create model inside model_map
        $model = new $model_class($this->client);
        if ($model) {
            $this->model_map[strtolower($name)] = $model;
            return $model;
        }

        throw new \Exception('Invalid model name ' . $name . ' for category ' . $this->category_name);
    }
}