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
    public $productDir;
    public $modelDir;
    public $resource;
    public $resourceUrlPath;
    public $resourceId;
    public $resourceClass;
    public $resourceServiceClass;

    /**
     * ResourceMetadata constructor.
     * @param string $product
     * @param string $resource
     * @throws Exception
     */
    public function __construct($product, $resource = null)
    {
        $this->product = ucfirst(strtolower($product));
        $this->productClass = 'SecucardConnect\\Product\\' . $this->product;
        $this->productDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Product' .
            DIRECTORY_SEPARATOR . $this->product;
        $this->modelDir = $this->productDir . DIRECTORY_SEPARATOR . 'Model';

        if (empty($resource)) {
            return; // just initialize product data
        }

        $classPrefix = $this->productClass . '\\';
        $this->resource = ucfirst(strtolower($resource));
        $this->resourceUrlPath = $this->product . '/' . $this->resource;

        $cls = $this->findServiceClass($this->productDir, $this->resource, $classPrefix);
        if ($cls == null) {
            throw new ClientError('Unable to find service for "' . $product . '/' . $resource
                . '", expected to find similar to "Product\\<Product>\\<Resource>Service"');
        }
        $this->resourceServiceClass = $cls;

        $this->resourceId = strtolower($this->product . '.' . $this->resource);

        $cls = $this->findModelClass($this->modelDir, $this->resource, $classPrefix);
        if ($cls == null) {
            throw new ClientError('Unable to find a class for resource ' . $this->resource
                . '", expected to find similar to "Product\\<Product>\\Model\\<Resource or singular of Resource>"');
        }
        $this->resourceClass = $cls;
    }

    /**
     * check all classes in this product model dir against the given resource name to find the right resource class
     * necessary because class name may be singular of resource name (seems safer than just stripping the "s")
     * @param string $dir
     * @param string $resource
     * @param string $classPrefix
     * @return null|string
     * @throws \ReflectionException
     */
    private function findModelClass($dir, $resource, $classPrefix)
    {
        $lcres = strtolower($resource);
        $files = glob($dir . DIRECTORY_SEPARATOR . '*.php');
        foreach ($files as $file) {
            $name = basename((string) $file, '.php');
            if (strpos($lcres, strtolower($name)) !== false) {
                $cls = $classPrefix . 'Model\\' . $name;
                $rc = new \ReflectionClass($cls);

                // collect all in hierarchy
                $parents = [];
                while (($parent = $rc->getParentClass()) && $parent) {
                    $parents[] = $parent;
                    $rc = new \ReflectionClass($parent->getName());
                }

                foreach ($parents as $parent) {
                    if (BaseModel::class === $parent->getName()) {
                        return $cls;
                    }
                }
            }
        }

        return null;
    }

    /**
     * @param string $dir
     * @param string $resource
     * @param string $classPrefix
     *
     * @return null|string
     * @throws \ReflectionException
     */
    private function findServiceClass($dir, $resource, $classPrefix)
    {
        $lcres = strtolower($resource);
        $files = glob($dir . DIRECTORY_SEPARATOR . '*Service.php');
        foreach ($files as $file) {
            $name = basename((string) $file, '.php');
            if (strpos(strtolower($name), $lcres) !== false) {
                $parentClassName = $className = $classPrefix . $name;

                do {
                    $rc = new \ReflectionClass($parentClassName);
                    $parent = $rc->getParentClass();

                    if (!$parent) {
                        break;
                    }

                    $parentClassName = $parent->getName();

                    if (ProductService::class === $parentClassName) {
                        return $className;
                    }

                } while (true);
            }
        }

        return null;
    }
}
