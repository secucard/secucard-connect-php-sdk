<?php
/**
 * Base Model class
 */

namespace SecucardConnect\Product\Common\Model;

/**
 * Class that should be used as parent class of every Data model
 * Class does not implement lazy loading, so it cannot carry relations
 *
 * @author Jakub Elias <j.elias@secupay.ag>
 */
abstract class BaseModel
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $object;


    /**
     * ToString Function
     */
    public function __toString()
    {
        return print_r($this, true);
    }

    /**
     * Returns an array with property names to exclude from JSON encoding when they have a null value. This method
     * will be called when this model object is marshaled to JSON (e.g. when submitted to server) and is necessary to
     * prevent submitting properties which are not set yet (results in server errors else).
     * Override in model classes with the actual names.
     * @return array Array with property names.
     */
    public function jsonFilterNullProperties()
    {
        return null;
    }

    /**
     * Returns an array with property names to exclude from JSON encoding.
     * This method will be called when this model object is marshaled to JSON (e.g. when submitted to server)
     * and may be used to prevent submitting (private) properties.
     * Override in model classes with the actual names.
     * @return array Array with property names.
     */
    public function jsonFilterProperties()
    {
        return null;
    }
}