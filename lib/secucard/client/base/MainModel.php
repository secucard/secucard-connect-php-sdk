<?php
/**
 * Main Model class
 */

namespace secucard\client\base;

/**
 * Class that should be used as parent class of every Complex data Model
 * Implements lazy loading of related objects
 *
 * @author Jakub Elias <j.elias@secupay.ag>
 */
abstract class MainModel extends BaseModel
{
    /**
     * Api client used for lazy loading
     * @var \secucard\client\api\Client
     */
    protected $client;

    /**
     * Constructor
     * @param obj $client
     */
    public function __construct(\secucard\client\api\Client &$client)
    {
        $this->client = $client;
        parent::__construct();
    }

    /**
     * Magic setter
     * @param string $name
     * @param mixed $value
     *
    public function __set($name, $value)
    {
        if ($name == 'id' && !empty($this->_id_column)) {
            return $this->set_attribute($this->_id_column, $value);
        }
        return $this->set_attribute($name, $value);
    }


    /**
     * Function to get list of MainModels
     * @param array $options
     * @return BaseCollection $list
     */
    public function getList($options)
    {
        $list = new BaseCollection($this->client, get_class($this));
        $list->loadItems($options);
        return $list;
    }

    /**
     * Magic getter
     * @param string $name
     *
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
     * Method to get object identified by id
     * @param $id
     */
    public function get($id)
    {
        $response = '';
        return $response;
    }

    /**
     * Function to save object
     * It can update existing or create new object
     * SAVE function in future
     * @return bool true on success
     */
    public function save()
    {
        if ($this->initialized) {
            // Update object
            // call api somehow
            // probably static api?

            return true;
        }

        // call create api function
        // pass object there
        // TODO initialize response correctly
        $response = array();
        $this->_attributes[$this->_id_column] = $response[$this->_id_column];
        return true;

    }
}