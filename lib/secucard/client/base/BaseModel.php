<?php
/**
 * Base Model class
 */

namespace secucard\client\base;

/**
 * Class that should be used as parent class of every Data model
 * Class does not implement lazy loading
 *
 * @author Jakub Elias <j.elias@secupay.ag>
 */
abstract class BaseModel
{
    /**
     * Date type constants
     */
    const DATA_TYPE_BOOLEAN = 'boolean';
    const DATA_TYPE_DATE = 'date';
    const DATA_TYPE_DATETIME = 'datetime';
    const DATA_TYPE_FLOAT = 'float';
    const DATA_TYPE_NUMBER = 'number';
    const DATA_TYPE_STRING = 'string';

    const RELATION_HAS_ONE = 'has_one';
    const RELATION_HAS_MANY = 'has_many';

    // todo

    /**
     * Array where attributes for current object are defined
     * @var array
     */
    protected $_attribute_defs = array();

    /**
     * Array where relations for current object are defined
     * @var array
     */
    protected $_relations = array();

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
    public function __construct()
    {
        $this->setAttributes($this->_attribute_defs);
        $this->setRelations($this->_relations);
    }

    /**
     * Initialization function
     * @param mixed $data
     */
    public function init($data = array())
    {
        if (is_string($data)) {
            $data = array('id'=>$data);
        }
        if (!is_array($data)) {
            $data = array();
        }

        // Create object instance from attributes
        foreach ($this->_attribute_defs as $name => $definition) {
            if (isset($definition['options']['id'])) {
                $this->_id_column = $name;
                if (array_key_exists('id', $data)) {
                    $this->id = $data['id'];
                }
            }
        }
        if ($this->_relations) {
            foreach ($this->_relations as $name => $def) {
                if (array_key_exists($name, $data)) {
                    $property = $this->_attribute_defs[$name];
                    $class_name = '\\secucard\\models\\' . $def['class'];

                    if ($def['type'] == self::RELATION_HAS_ONE) {
                        $child = new $class_name($this->client);
                        // TODO do we need relations backwards
                        //$child->add_relationship($this, $name);
                        $this->set_attribute($name, $child);
                    } elseif ($def['type'] == self::RELATION_HAS_MANY) {

                        // We need to create collection of the right type
                        // TODO implement correctly!
                        //$this->set_attribute($name, $collection);
                    }
                }
            }
        }
    }

    /**
     * Magic setter
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if ($name == 'id' && !empty($this->_id_column)) {
            return $this->set_attribute($this->_id_column, $value);
        }
        return $this->set_attribute($name, $value);
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
        if ($this->has_attribute_value($name)) {
            // Create DateTime object if necessary
            if ($this->has_attribute($name) && ($this->_attribute_defs[$name]['type'] == 'datetime' || $this->_attribute_defs[$name]['type'] == 'date')) {
                $tz = new DateTimeZone('UTC');
                return DateTime::createFromFormat($this->date_format_for_property($name), $this->_attributes[$name], $tz);
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
        return print_r($this->as_json(false), true);
    }

    /**
     * Function to get date_format for date property
     * @param string $name
     * @return string $format
     */
    public function date_format_for_property($name)
    {
        if (!$this->has_attribute($name)) {
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
     * @throws DataIntegrityError
     */
    protected function set_attribute($name, $value)
    {
        if ($this->has_attribute($name)) {
            $definition = $this->_attribute_defs[$name];
            switch($definition['type']) {
                case self::DATA_TYPE_NUMBER:
                    $this->_attributes[$name] = $value ? (int)$value : null;
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
                case self::DATA_TYPE_STRING:
                    $this->_attributes[$name] = $value ? (string)$value : null;
                    break;
                // TODO :
                case self::RELATION_HAS_ONE:
                    $this->_attributes[$name] = array();
                    break;
                case 'hash':
                    $this->_attributes[$name] = $value ? (array)$value : array();
                    break;
                default:
                    $this->_attributes[$name] = $value;
            }
            return true;
        }
        throw new \Exception("Attribute '{$name}' cannot be assigned. Attibute doesn't exist.");
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

    public function has_attribute_value($name)
    {
        return array_key_exists($name, $this->_attributes);
    }

    public function has_attribute($name)
    {
        return array_key_exists($name, $this->_attribute_defs);
    }

    public function has_relationship($name)
    {
        return array_key_exists($name, $this->__relationships);
    }

    /**
     * Set Attributes for current model
     * @param array $attributes
     */
    protected function setAttributes($attributes)
    {
        foreach ($attributes as $attr => $def) {
            $this->_attribute_defs[$attr] = $def;
        }
    }

    public function setAttributesData($data, $initialized = false)
    {
        if ($this->initialized) {
            throw new \BadMethodCallException('Cannot set attributes on already initialized object');
        }

        foreach ($data as $attr_name => $value) {
            $this->set_attribute($attr_name, $value);
        }
        $this->initialized = $initialized;
    }

    /**
     * Set relations for current model
     * @param array $relations
     */
    protected function setRelations($relations)
    {
        $this->_relations = $relations;
    }

    /**
     * Function to initialize object attribute values from array
     * @param array $params
     * @return bool true on success
     */
    public function initializeAttributesFromArray($params)
    {
        if ($this->initialized) {
            throw new \Exception('Object already initialized, cannot initialize only subfields from array');
        }

        // TODO where should be a way to recognize if we are accessing field that has not yet been loaded
        foreach($params as $atr => $value) {
            $this->set_attribute($atr, $value);
        }

        return true;
    }

    /**
     * TODO this function probably can be needed when saving the MainModel and related objects
     * but not implemented correctly now
     *
     * @param unknown_type $encoded
     * @return multitype:NULL multitype: unknown multitype:NULL  |NULL
     */
    public function as_json($encoded = true)
    {
        $result = array();
        foreach ($this->_attribute_defs as $name => $definition) {
            if (!$this->has_relationship($name) && $this->has_attribute_value($name) && !is_null($this->_attributes[$name])) {
                $result[$name] = $this->_attributes[$name];
            }
        }
        foreach ($this->__relationships as $name => $type) {
            if ($type == self::RELATION_HAS_ONE) {
                $target_name = $name;
                if (!empty($this->_attribute_defs[$name]['options']['json_target'])) {
                    $target_name = $this->_attribute_defs[$name]['options']['json_target'];
                }

                if ($this->has_attribute_value($name)) {
                    if (!empty($this->_attribute_defs[$name]['options']['json_value'])) {
                        $result[$target_name] = $this->_attributes[$name]->{$this->_attribute_defs[$name]['options']['json_value']};
                    } elseif (is_a($this->_attributes[$name], 'BaseCollection')) {
                        foreach ($this->_attributes[$name] as $field) {
                            $key = '';// TODO set key correctly
                            $list[$key] = $field->as_json(false);
                        }
                        $result[$name] = $list;
                    } else {
                        $child = $this->_attributes[$name]->as_json(false);
                        if ($child) {
                            $result[$target_name] = $child;
                        }
                    }
                }
            } elseif ($type == self::RELATION_HAS_MANY) {
                if ($this->has_attribute_value($name)) {
                    $list = array();
                    foreach ($this->_attributes[$name] as $item) {
                        if (!empty($this->_attribute_defs[$name]['options']['json_value'])) {
                            $list[] = $item->{$this->_attribute_defs[$name]['options']['json_value']};
                        } else {
                            $list[] = $item->as_json(false);
                        }
                    }
                    if ($list) {
                        if (!empty($this->_attribute_defs[$name]['options']['json_target'])) {
                            $result[$this->_attribute_defs[$name]['options']['json_target']] = $list;
                        } else {
                            $result[$name] = $list;
                        }
                    }
                }
            }
        }

        if ($result) {
            return $encoded ? json_encode($result) : $result;
        }
        return null;
    }
}