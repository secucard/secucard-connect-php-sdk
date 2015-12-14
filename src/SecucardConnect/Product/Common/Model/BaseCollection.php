<?php
/**
 * Base collection class
 */

namespace SecucardConnect\Product\Common\Model;

use BadMethodCallException;
use Exception;

/**
 * Provides a simple iterator and array access interface to a array of BaseModel classes
 *
 * @author Jakub Elias <j.elias@secupay.ag>
 */
class BaseCollection implements \ArrayAccess, \Countable, \Iterator
{
    /**
     * Array of typed result objects.
     * @var array
     */
    public $items = array();

    /**
     * An unique id identifying the (server side) result set snapshot this items belong to.
     * Since the items (may) represent just a part of the whole data set this id can be used to scroll forward through
     * the search result set. Only set when this collection is requested as "scrollable".
     * @see  ProduService->getScrollableList()
     * @var string
     */
    public $scrollId;

    /**
     * The overall count of available items in the whole search result set. This collection items set itself may only
     * contain a fraction of the overall count.
     * @var int
     */
    public $totalCount;

    /**
     * The actual number of items in this collection.
     * This count may be less then requested by the query if the end of the result set is reached.
     * @var int
     */
    public $count;


    /**
     * Iterator position
     * @var int
     */
    public $position;

    /**
     * A flag that is set to true when the end of the list is reached (for lazy loading)
     * @var bool
     */
    public $reachedEnd;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->position = 0;
        $this->count = 0;
        $this->offset = 0;
        $this->reached_end = false;
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
            $current_item = new $item_class($this->client, $this->itemPath);
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
        foreach ($this->_items as $item) {
            $items[] = $item->as_json(false);
        }
        return print_r($items, true);
    }


    /**
     * {@inheritDoc}
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
     * Array access, set item by offset
     * @param mixed $offset
     * @param object $value
     * @throws Exception
     * @internal param offset $int
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
        //$this->_items = $items;
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
     * Function to rewind iterator to the beginning
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
        $options = array('scroll_id' => $this->scroll_id, 'offset' => $this->offset);
        $this->loadItems($options);
        return true;
    }
}