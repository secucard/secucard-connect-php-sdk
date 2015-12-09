<?php

namespace SecucardConnect\Client;


use Exception;
use SecucardConnect\Product\Common\Model\BaseModel;

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
            throw new ClientError('Unable to find service for "' . $product . '/' . $resource
                . '", expected to find similiar to "Product\\<Product>\\<Resource>Service"');
        }

        $rc = new \ReflectionClass($this->resourceServiceClass);


        $dir = dirname($rc->getFileName());

        $this->resourcePath = $this->product . '/' . $this->resource;

        // check all classes in this product model dir against the given resource name to find the right resource class
        // necessary because class name may be singular of resource name (seems safer than just stripping the "s")
        $basicresource = strtolower($this->resource);
        $files = glob($dir . '/Model/*.php');
        foreach ($files as $file) {
            $name = basename($file, '.php');
            if (strpos($basicresource, strtolower($name)) !== false) {
                $cls = $classPrefix . 'Model\\' . $name;
                $rc = new \ReflectionClass($cls);
                $parents = $rc->getParentClass();
                foreach ($parents as $parent) {
                    if ($parent === BaseModel::class) {
                        $this->resourceClass = $cls;
                        return;
                    }
                }
            }
        }

        throw new ClientError('Unable to find a class for resource ' . $this->resource
            . '", expected to find similiar to "Product\\<Product>\\Model\\<Resource or singular of Resource>"');
    }
}