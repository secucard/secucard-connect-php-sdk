<?php
/**
 * Base Model class
 */

namespace secucard\client\base;

/**
 * Class that should be used as parent class of every Data model
 * Class does not implement lazy loading, so it cannot carry relations
 *
 * @author Jakub Elias <j.elias@secupay.ag>
 */
abstract class BaseModel
{
    /**
     * Date type constants
     */
    const DATA_TYPE_ARRAY = 'array';
    const DATA_TYPE_ARRAY_SUBOBJECT = 'array_subobject';
    const DATA_TYPE_BOOLEAN = 'boolean';
    const DATA_TYPE_DATE = 'date';
    const DATA_TYPE_DATETIME = 'datetime';
    const DATA_TYPE_FLOAT = 'float';
    const DATA_TYPE_NUMBER = 'number';
    const DATA_TYPE_STRING = 'string';
    const DATA_TYPE_URL = 'url';

    /**
     * Array where attributes for current object are defined
     * @var array
     */
    protected $_attribute_defs = array();

    /**
     * Associative array of values for attributes of current object
     * @var array
     */
    protected $_attributes = array();

    /**
     * Flag that indicates if the data fields are initialized from DB
     * @var bool
     */
    protected $initialized = false;

    /**
     * Name of the primary key column
     * @var string
     */
    protected $_id_column;

    /**
     * Constructor
     */
    public function __construct($client = null)
    {
        $this->setAttributes($this->_attribute_defs);
    }

    /**
     * Initialization function to set value for attributes
     * @param array $values
     * @param boolean $initialized default false
     * @throws \BadMethodCallException
     * @return boolean
     */
    public function initValues($values, $initialized = false)
    {
        if ($this->initialized) {
            throw new \BadMethodCallException('Cannot set attributes on already initialized object');
        }

        return $this->_initValues($values, $initialized);
    }

    /**
     * Magic setter
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if ($name == 'id' && !empty($this->_id_column)) {
            return $this->setAttribute($this->_id_column, $value);
        }
        return $this->setAttribute($name, $value);
    }

    /**
     * Magic getter
     * @param string $name
     */
    public function __get($name)
    {
        if ($name == 'id' && !empty($this->_id_column)) {
            return empty($this->_attributes[$this->_id_column]) ? null : $this->_attributes[$this->_id_column];
        }
        if ($this->hasAttributeValue($name)) {
            // Create DateTime object if necessary
            if ($this->hasAttribute($name) && in_array($this->_attribute_defs[$name]['type'], array(self::DATA_TYPE_DATETIME, self::DATA_TYPE_DATE))) {
                $timezone = new DateTimeZone('UTC');
                return DateTime::createFromFormat($this->getDateFormatForAttribute($name), $this->_attributes[$name], $timezone);
            }

            return $this->_attributes[$name];
        }
    }

    /**
     * Magic isset function
     * @param string $name
     */
    public function __isset($name)
    {
        return isset($this->_attributes[$name]);
    }

    /**
     * Magic unset function
     * @param string $name
     */
    public function __unset($name)
    {
        unset($this->_attributes[$name]);
    }

    /**
     * ToString Function
     */
    public function __toString()
    {
        return print_r(json_encode($this->_attributes), true);
    }

    /**
     * Function to get date_format for date property
     * @param string $name
     * @return string $format
     */
    public function getDateFormatForAttribute($name)
    {
        if (!$this->hasAttribute($name)) {
            return '';
        }
        if ($this->_attribute_defs[$name]['type'] == self::DATA_TYPE_DATETIME) {
            return 'Y-m-d H:i:s';
        }
        if ($this->_attribute_defs[$name]['type'] == self::DATA_TYPE_DATE) {
            return 'Y-m-d';
        }
    }

    /**
     * Function to set attribute value
     * @param string $name
     * @param mixed $value
     * @throws Exception
     * @return boolean
     */
    protected function setAttribute($name, $value)
    {
        if (!$this->hasAttribute($name)) {
            throw new \Exception("Attribute '{$name}' cannot be assigned. Attribute doesn't exist");
        }

        $definition = $this->_attribute_defs[$name];
        switch ($definition['type']) {
            case self::DATA_TYPE_ARRAY:
                if (is_array($value)) {
                    $this->_attributes[$name] = $value;
                } else {
                    $this->_attributes[$name] = array($value);
                }
                break;
            case self::DATA_TYPE_ARRAY_SUBOBJECT:
                if (!empty($value) && is_array($value)) {
                    // we have a subobject inside an array. We will just validate the $value and set the array to _attributes
                    $class_name = '\\secucard\\models\\' . $definition['category'] . '\\' . $definition['model'];
                    $attribute_obj = new $class_name();
                    $attribute_obj->initValues($value);
                    $this->_attributes[$name] = $value;
                } else {
                    $this->_attributes[$name] = array($value);
                }
                break;
            case self::DATA_TYPE_BOOLEAN:
                $this->_attributes[$name] = null;
                if ($value === true || $value === false) {
                    $this->_attributes[$name] = $value;
                } elseif ($value) {
                    $this->_attributes[$name] = in_array(trim(strtolower($value)), array('true', 1, 'yes'));
                }
                break;
            case self::DATA_TYPE_FLOAT:
                $this->_attributes[$name] = $value ? floatval($value) : null;
                break;
            case self::DATA_TYPE_DATETIME:
            case self::DATA_TYPE_DATE:
                if (is_a($value, 'DateTime')) {
                    $this->_attributes[$name] = $value->format($this->date_format_for_property($name));
                } else {
                    $this->_attributes[$name] = $value;
                }
                break;
            case self::DATA_TYPE_NUMBER:
                $this->_attributes[$name] = $value ? (int)$value : null;
                break;
            case self::DATA_TYPE_STRING:
                $this->_attributes[$name] = $value ? (string)$value : null;
                break;
            case self::DATA_TYPE_URL:
                $this->_attributes[$name] = $value ? (string)$value : null;
                break;
            default:
                $this->_attributes[$name] = $value;
        }
        return true;
    }

    /**
     * Set Attributes for current model
     * @param array $attributes
     * @throws \BadMethodCallException
     * @return boolean
     */
    protected function setAttributes($attributes)
    {
        if ($this->initialized) {
            throw new \BadMethodCallException('Cannot set attributes definition for already initialized object');
        }

        foreach ($attributes as $attr_name => $def) {
            $this->_attribute_defs[$attr_name] = $def;
            if (!empty($def['options']) && !empty($def['options']['id'])) {
                $this->_id_column = $attr_name;
            }
        }

        return true;
    }

    /**
     * Function to initialize attributes and relations from array (obtained from API call)
     * @param array $values
     * @param bool $initialized
     * @return bool true/false
     */
    protected function _initValues($values, $initialized)
    {
        if (!is_array($values) || empty($values)) {
            return false;
        }

        foreach ($values as $attr_name => $value) {
            // we need here to call the magic setter for descendant class
            $this->setAttribute($attr_name, $value);
        }

        $this->initialized = $initialized;

        return true;
    }

    /**
     * Function that creates attributes for saving
     * @return array
     */
    public function getUpdateAttributes()
    {
        return $this->_attributes;
    }

    /**
     * Function that will return the URL path for current model
     * @return string $path
     */
    protected function getCurrentModelUrlPath()
    {
        $current_class = get_class($this);
        $path = str_replace('\\', '/', substr($current_class, strlen('secucard\\models\\')));
        return $path;
    }

    /**
     * Function to return true, if attribute with $name is set
     * @param string $name
     * @retun bool true|false
     */
    public function hasAttributeValue($name)
    {
        return array_key_exists($name, $this->_attributes);
    }

    /**
     * Function to return true, if current object has defined attribute for $name
     * @param string $name
     * @return bool true|false
     */
    public function hasAttribute($name)
    {
        return array_key_exists($name, $this->_attribute_defs);
    }

    /**
     * Function to get the attributes for current object as json
     *
     * @param bool $return_encoded
     * @return string|array
     */
    public function as_json($return_encoded = true)
    {
        $result = array();
        foreach ($this->_attribute_defs as $name => $definition) {
            if ($this->hasAttributeValue($name) && !is_null($this->_attributes[$name])) {
                $result[$name] = $this->_attributes[$name];
            }
        }

        return $return_encoded ? json_encode($result) : $result;
    }
}