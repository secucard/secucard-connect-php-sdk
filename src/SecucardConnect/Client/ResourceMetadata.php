<?php

namespace SecucardConnect\Client;


use Exception;

/**
 * Hold all names, class names, service names and paths of a particular resource.
 * Encapsulates the naming convention part of resources and products.
 * @package SecucardConnect\Client
 */
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
        $this->resourceServiceClass = $classPrefix . $this->resource . 'Service';

        if (!class_exists($this->resourceServiceClass, true)) {
            throw new ClientError('Unknown service "' . $resource . '" for product "' . $product . '".');
        }

        $rc = new \ReflectionClass($this->resourceServiceClass);

        $dir = dirname($rc->getFileName());

        $this->resourcePath = $this->product . '/' . $this->resource;

        // check all classes in this product model dir against the given resource name to find the right resource class
        // necessary because class name is singular of resource name (seems safer than just stripping the "s")
        $files = glob($dir . '/Model/*.php');
        foreach ($files as $file) {
            $name = basename($file, '.php');
            if (strpos($this->resource, $name) !== false) {
                $this->resourceClass = $classPrefix . 'Model\\' . $name;
                return;
            }
        }

        throw new ClientError('Unable to find a resource class for resource ' . $this->resource);
    }
}