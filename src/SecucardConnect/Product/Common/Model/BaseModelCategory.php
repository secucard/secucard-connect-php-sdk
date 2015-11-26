<?php
/**
 * Base Model Category class file
 */

namespace SecucardConnect\Product\Common\Model;
use SecucardConnect\SecucardConnect;

/**
 * Base Model Category class to allow to use $client->category->model->method design pattern
 *
 * @author Jakub Elias <j.elias@secupay.ag>
 */
class BaseModelCategory
{
    /**
     * client that will be used for models
     * @var SecucardConnect
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
    public function __construct(SecucardConnect &$client, $category_name)
    {
        $this->client = $client;
        $this->category_name = $category_name;
    }

    /**
     * Magic getter for getting the model object inside category uses lazy loading for modules
     * Function can become more complex if we allow the category names to begin with lowercase letter
     *
     * @param string $name
     * @return MainModel instance of class for model
     * @throws \Exception
     */
    public function __get($name)
    {
        $resource = ucfirst(strtolower($name));

        if (isset($this->model_map[$resource])) {
            return $this->model_map[$resource];
        }
        $model_class = '\\SecucardConnect\\Product\\' . $this->category_name . '\\Model\\' . $resource;

        // create model inside model_map
        $model = new $model_class($this->client, array($this->category_name, $resource));
        if ($model) {
            $this->model_map[$resource] = $model;
            return $model;
        }

        throw new \Exception('Invalid model name ' . $name . ' for category ' . $this->category_name);
    }
}