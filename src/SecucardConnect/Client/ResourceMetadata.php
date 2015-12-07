<?php

namespace SecucardConnect\Client;


use Exception;

class ResourceMetadata
{
    public $product;
    public $productClass;
    public $resource;
    public $resourcePath;
    public $resourceClass;
    public $resourceServiceClass;

    /**
     * ResourceMetadata constructor.
     * @param $product
     * @param $resource
     * @throws Exception
     */
    public function __construct($product, $resource = null)
    {
        $this->product = ucfirst(strtolower($product));
        $this->productClass = '\\SecucardConnect\\Product\\' . $this->product;
        $classPrefix = $this->productClass . '\\';

        if (empty($resource)) {
            return; // just initialize product data
        }

        $this->resource = ucfirst(strtolower($resource));
        $this->resourcePath = $this->product . '/' . $this->resource;
        $this->resourceClass = $classPrefix . 'Model\\' . $this->resource;
        $this->resourceServiceClass = $classPrefix . $this->resource . 'Service';

        if (!class_exists($this->resourceServiceClass, true)) {
            throw new Exception('Unknown service "' . $resource . '" for product "' . $product . '".');
        }
    }
}