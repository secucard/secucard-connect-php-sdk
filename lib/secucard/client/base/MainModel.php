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
     * Constant definition
     */
    const RELATION_HAS_ONE = 'has_one';
    const RELATION_HAS_MANY = 'has_many';

    /**
     * Api client used for lazy loading
     * @var \secucard\client\api\Client
     */
    protected $client;

    /**
     * Array where relations for current object are defined
     * @var array
     */
    protected $_relations = array();

    /**
     * Array of related objects
     * @var array
     */
    protected $_related = array();

    /**
     * Constructor
     * @param obj $client
     */
    public function __construct(\secucard\Client &$client)
    {
        $this->client = $client;
        $this->setRelations($this->_relations);
        parent::__construct();
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
     * Function to check if the relation to $name exists
     * @param string $name
     * @return bool
     */
    public function hasRelation($name)
    {
        return array_key_exists($name, $this->_relations);
    }

    /**
     * Override this function if model can be deleted
     * @return bool
     */
    public function isRemovable()
    {
        return false;
    }

    /**
     * Override this function if model can be updated
     * @return bool
     */
    public function isUpdatable()
    {
        return false;
    }

    /**
     * Magic getter
     * @param string $name
     */
    public function __get($name)
    {
        // TODO recognize if object is loaded , if not, then load it!
        if (!$this->initialized) {
            if (!isset($this->_attributes[$name]) && !empty($this->_attribute_defs[$name])
                || !isset($this->_related[$name]) && !empty($this->_relations[$name])) {
                // lazy load current object!
                $this->lazyLoadSelf();
            }
        }
        if (isset($this->_relations[$name])) {
            // return the related object
            return $this->getRelated($name);
        }

        return parent::__get($name);
    }

    /**
     * Magic setter
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if (isset($this->_relations[$name])) {
            return $this->setAttribute($name, $value);
        }

        return parent::__set($name, $value);
    }

    /**
     * Magic isset function
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        if (isset($this->_related[$name])) {
            return true;
        }
        return parent::__isset($name);
    }

    /**
     * Magic unset function
     * @param string $name
     */
    public function __unset($name)
    {
        if (isset($this->_related[$name])) {
            unset($this->_related[$name]);
        }
        return parent::__unset($name);
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
     * Method to get object identified by id
     * @param $id
     * @return new instance of current class or null
     */
    public function get($id)
    {
        if (empty($id)) {
            throw new \Exception('cannot load object with empty id');
        }
        $new_obj = null;

        $response = $this->getResponse($id);

        if (!empty($response)) {
            $current_class = get_class($this);
            $new_obj = new $current_class($this->client);
            $new_obj->initValues($response, true);
        }

        return $new_obj;
    }

    /**
     * Function to delete the model identified by id
     * @param string $id default null
     * @throws \Exception
     * @return bool
     */
    public function delete($id = null)
    {
        if (!$this->isRemovable()) {
            $this->client->logger->warning('Trying to delete model ' . get_class($this) . ' but it is not removable');
            return false;
        }
        // TODO move the static path of path to some configuration
        $path = '/app.core.connector/api/v2/' . $this->getCurrentModelUrlPath() . '/';
        if (empty($id)) {
            if (!$this->initialized || empty($this->_attributes[$this->_id_column])) {
                throw new \Exception('cannot delete object with empty primary key value');
            }
            $path .=  $this->_attributes[$this->_id_column];
        } else {
            $path .= $id;
        }

        $options = array();

        $response = $this->client->delete($path, $options);
        return $response;
    }

    /**
     * Function that creates attributes for saving
     * @return array
     */
    public function getUpdateAttributes()
    {
        $ret = $this->_attributes;

        foreach ($this->_related as $name => $related) {
            switch ($this->_relations[$name]['type']) {
                case MainModel::RELATION_HAS_MANY:
                    foreach ($related as $related_sub) {
                         $ret[$name][] = $related_sub->getUpdateAttributes();
                    }
                    break;
                case MainModel::RELATION_HAS_ONE:
                    $ret[$name] = $related->getUpdateAttributes();
                    break;
            }
        }

        return $ret;
    }

    /**
     * Function to save object
     * It can update existing or create new object
     *
     * @return bool true on success
     */
    public function save()
    {
        $path = $this->getCurrentModelUrlPath() . '/';

        // check if we should update object
        if (!empty($this->_id_column) && !empty($this->_attributes[$this->_id_column])) {
            // update the existing record
            if (!$this->initialized) {
                throw new \Exception('Trying to save not initialized item');
            }

            if (!$this->isUpdatable()) {
                $this->client->logger->warning('Trying to update model ' . get_class($this) . ' but it is not updatable!');
                return false;
            }

            $path .= $this->_attributes[$this->_id_column];
            var_dump($this->_attributes);
            $response = $this->client->put($path, $this->getUpdateAttributes(), array());
            // TODO check response and process it
            return true;
        }
        // add new object

        $response = $this->client->post($path, $this->getUpdateAttributes(), array());
        // TODO get the object id from response
        // following value is not correct:
        $response_json = $response->json();
        $this->_attributes[$this->_id_column] = $response_json[$this->_id_column];
        // or initialize object from the response.. there can be some field values fixed
        // TODO
        return true;

    }

    /**
     * This method will return the related object of the current object
     * If the relation is HAS_ONE or BELONGS_TO, it will return a single object or null if the object does not exist
     * If the relation is HAS_MANY or MANY_MANY, it will return an array of objects or an empty array
     *
     * @param string $name the relation name (see {@link relations})
     * @param boolean $refresh whether to reload the related objects from API
     * @return mixed the related object
     * @throws Exception if the relation is not specified
     */
    public function getRelated($name, $refresh=false)
    {
        if(!$refresh && (isset($this->_related[$name]) || array_key_exists($name, $this->_related))) {
            return $this->_related[$name];
        }

        // check if the object has defined relation for $name
        if (!$this->hasRelation($name)) {
            throw new \Exception(get_class($this) . ' does not have relation "' . $name . '"');
        }
        $relation_def = $this->_relations[$name];

        $this->client->logger->info('lazy loading '. get_class($this).'.'. $name);

        if ($refresh) {
            unset($this->_related[$name]);
        }

        // check if we should try to load related object (check if the related object exists..)
        if ($this->initialized && empty($this->_related[$name])) {
            $this->_related[$name] = null;
        } else {
            // get new object
            $this->lazyLoad($relation_def);
        }

        return $this->_related[$name];
    }

    /**
     * Function to set Attribute or relation on current model
     * @param string $name
     * @param mixed $value
     * @return bool
     */
    public function setAttribute($name, $value)
    {
        if ($this->hasRelation($name)) {
            // we have to set the relation correctly
            $relation_def = $this->_relations[$name];
            $related_category = $relation_def['category'];
            $related_model = $relation_def['model'];
            $class_name = '\\secucard\\models\\' . $related_category . '\\' . $related_model;
            if ($relation_def['type'] == self::RELATION_HAS_ONE) {
                $related_obj = new $class_name($this->client);
                $related_obj->initValues($value);
                $this->_related[$name] = $related_obj;
            } else {
                // create collection from the values
                $collection = new \secucard\client\base\BaseCollection($this->client, $class_name);
                $collection->loadFromArray($value);
                $this->_related[$name] = $collection;
            }
            return true;
        }

        return parent::setAttribute($name, $value);
    }

    // TODO think what would be the best return value
    private function lazyLoad($relation_def)
    {
        $related_category = $relation_def['category'];
        $related_model = $relation_def['model'];

        // We should recognize if the related object exists or not!

        switch ($relation_def['type']) {
            case self::RELATION_HAS_ONE:
                //$join_column_name = $relation_def['foreing_key'];
                // if the related object is not defined
                if (empty($this->$join_column_name)) {
                    return false;
                }
                $related_obj = $this->client->$related_category->$related_model->get($this->$join_column_name);
                if (!$related_obj) {
                    return false;
                }
                $this->_related[$name] = $related_obj;
                break;
            case self::RELATION_HAS_MANY:
                // TODO there should be some conditions for joining, cross join is not very good
                $options = array();
                $related_col = $this->client->$related_category->$related_model->getList($options);
                $this->_related[$name] = $related_col;
                break;
            default:
                throw new Exception('Invalid relation type: ' . $relation_def['type']);
                break;
        }

        return true;
    }

    /**
     * Function to load data for current object
     * @throws \Exception
     */
    private function lazyLoadSelf()
    {
        $id_column = $this->_id_column;
        if (empty($id_column)) {
            throw new \Exception('primary key not defined, cannot lazy load self');
        }

        $response = $this->getResponse($this->$id_column);

        // this call can cause problems if unexpected attribute will be returned from API call!! TODO fix me!
        $this->initValues($response, true);
    }

    /**
     * Function to send GET http request
     * @param string $id
     * @return array
     */
    private function getResponse($id)
    {
        $path = $this->getCurrentModelUrlPath();
        $options = array();

        // TODO fix
        $response = $this->client->get($path . '/' . $id, array('query'=>$options));
        return  $response->json();
    }

    /**
     * Function to get the attributes for current object as json
     *
     * @param bool $return_encoded
     * @return string|array
     */
    public function as_json($return_encoded = true)
    {
        $result = parent::as_json(false);
        foreach ($this->_relations as $name => $definition) {
            $type = $definition['type'];
            if ($type == self::RELATION_HAS_ONE) {
                $child = null;
                if ($this->_related[$name]) {
                    $child = $this->_related[$name]->as_json(false);
                }
                $result[$name] = $child;
            } elseif ($type == self::RELATION_HAS_MANY) {
                $children = array();
                if ($this->_related[$name]) {
                    foreach ($this->_related[$name] as $rel_child) {
                        $children[] = $rel_child->as_json(false);
                    }
                }
                $result[$name] = $children;
            }
        }

        return $return_encoded ? json_encode($result) : $result;
    }
}