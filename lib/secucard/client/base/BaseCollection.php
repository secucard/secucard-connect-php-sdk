<?php
/**
 * Base collection class
 */

namespace secucard\client\base;

/**
 * Provides a simple iterator and array access interface to a array of BaseModel classes
 *
 * @author Jakub Elias <j.elias@secupay.ag>
 */
class BaseCollection implements \ArrayAccess, \Countable, \Iterator
{
    /**
     * Client for subobjects to be able to reload data
     * @var secucard\client\api\Client
     */
    private $client;

    /**
     * Array of items inside collection
     * @var array
     */
    private $_items = array();

    /**
     * Scroll_id for collection
     * @var string
     */
    private $scroll_id;

    /**
     * Count of items returned by Api
     * @var int
     */
    private $count;

    /**
     * Current offset of data
     * @var int
     */
    private $offset;

    /**
     * Item type class name
     * @var string
     */
    private $item_type;

    /**
     * Iterator position
     * @var int
     */
    private $position;

    /**
     * A flag that is set to true when the end of the list is reached (for lazy loading)
     * @var bool
     */
    private $reached_end;

    /**
     * Constructor
     * @param secucard\client\api\Client
     * @param string $item_type - to know which objects should be inside the array
     */
    public function __construct($client, $item_type)
    {
        $this->position = 0;
        $this->count = 0;
        $this->offset = 0;
        $this->reached_end = false;
        $this->client = $client;
        if (empty($item_type)) {
            throw new Exception('Item type cannot be empty');
        }
        $this->item_type = $item_type;
    }

    /**
     * Function to add items to collection
     *
     * @param object $response
     */
    public function parseResponse($response)
    {
        if (is_object($response)) {
            $response = (array)$response;
        }
        if (isset($response['count'])) {
            $this->count = $response['count'];
        }
        if (isset($response['offset'])) {
            $this->offset = $response['offset'];
        }
        if (isset($response['scroll_id'])) {
            $this->scroll_id = $response['scroll_id'];
        }

        if (!isset($response['data'])) {
            return;
        }
        $item_class = $this->item_type;

        foreach ($response['data'] as $item) {
            $current_item = new $item_class($this->client);
            // set initialized flag for item to true (we expect all data to be available in the server response)
            $current_item->initValues($item, true);
            // add current_item to $this->_items array
            $this->_items[] = $current_item;
        }

        // check if we reached end of all items for iteration
        if ($this->count == count($this->_items)) {
            $this->client->logger->info('reached end of a collection');
            $this->reached_end = true;
        }
    }

    /**
     * Function to add items to collection
     *
     * @param array $data
     */
    public function loadFromArray($data)
    {
        if (empty($data) || !is_array($data)) {
            return;
        }

        $item_class = $this->item_type;

        foreach ($data as $item) {
            $current_item = new $item_class($this->client);
            $current_item->initValues($item);
            // add current_item to $this->_items array
            $this->_items[] = $current_item;
        }
        // set correct count
        $this->count = count($this->_items);
        $this->position = 0;
        $this->offset = 0;
        $this->reached_end = true;
    }

    /**
     * Convert collection to string
     * @return string
     */
    public function __toString()
    {
        $items = array();
        foreach($this->_items as $item) {
            $items[] = $item->as_json(false);
        }
        return print_r($items, true);
    }

    /**
     * Implements Countable
     * Returns count of all items in collection (even with the not loaded parts)
     */
    public function count()
    {
        return $this->count;
    }

    /**
     * Implements IteratorAggregate
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->_items);
    }

    /**
     * Function that returns Url path for current model
     * @return string
     */
    public function getUrlPath()
    {
        return str_replace('\\', '/', substr($this->item_type, strlen('secucard\\models\\')));
    }

    /**
     * Function to load items for $options
     * @param array $options
     */
    public function loadItems($options)
    {
        $path = $this->getUrlPath();

        $response = $this->client->get($path, array('query'=>$options));
        $this->parseResponse($response->json());
    }

    /**
     * Array access, set item by offset
     * @param int offset
     * @param object $value
     */
    public function offsetSet($offset, $value)
    {
        if (!is_a($value, 'BaseModel')) {
            throw new \Exception("Objects in BaseCollection must be type BaseModel");
        }

        if (is_null($offset)) {
            $this->_items[] = $value;
        } else {
            $this->_items[$offset] = $value;
        }
    }

    /**
     * Array access, get on specified offset
     * @param int $offset
     */
    public function offsetGet($offset)
    {
        return isset($this->_items[$offset]) ? $this->_items[$offset] : null;
    }

    /**
     * Check if offset exists
     * @inherited from ArrayAccess interface
     */
    public function offsetExists($offset)
    {
        return isset($this->_items[$offset]);
    }

    /**
     * @inherited from ArrayAcces Interface
     * NOT implemented
     */
    public function offsetUnset($offset)
    {
        throw new BadMethodCallException('not implemented');
    }

    /**
     * Return the raw array of objects
     * @return array
     */
    public function _get_items()
    {
        return $this->_items;
    }

    /**
     * Set the raw array of objects, Internal use only
     * @param array $items
     */
    public function _set_items($items)
    {
        throw new BadMethodCallException('not implemented');
        $this->_items = $items;
    }

    /**
     * Get object in the collection by id
     * @param string $id
     * @return $item|null
     */
    public function get($id)
    {
        foreach ($this->_items as $item) {
            if ($item->id === $id) {
                return $item;
            }
        }
        return null;
    }

    /**
     * ITERATOR INTERFACE FUNCTIONS
     */

     /**
      * Function to rewind iterator to the begining
      */
     public function rewind()
     {
         $this->position = 0;
     }

     /**
      * Function to get item on current position
      */
     public function current()
     {
         return $this->_items[$this->position];
     }

     public function key()
     {
         return $this->position;
     }

     /**
      * Function to move position to next item
      * This function uses lazy loading to load another data when the currently loaded data ends
      */
     public function next()
     {
         ++$this->position;

         // if we are on the last item, try to load new items
         if ($this->position == count($this->_items)) {
             $this->loadNextScroll();
         }
     }

     /**
      * check if current position is valid
      */
     public function valid()
     {
         return isset($this->_items[$this->position]);
     }

     /**
      * Function that tries to load next scroll
      * @return boolean
      */
     private function loadNextScroll()
     {
         if ($this->reached_end) {
             return false;
         }
         $this->client->logger->info('trying to load next scroll, offset (' . $this->offset . ')');
         // set offset to the count of all downloaded items
         $this->offset = count($this->_items);

         // option array for the loadItems request
         $options = array('scroll_id'=>$this->scroll_id, 'offset'=>$this->offset);
         $this->loadItems($options);
         return true;
     }
}