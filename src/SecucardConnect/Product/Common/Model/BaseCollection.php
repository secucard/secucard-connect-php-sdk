<?php

namespace SecucardConnect\Product\Common\Model;

use Countable;

/**
 * Collection of BaseModel instances.
 * Provides an iterator and countable interface.
 */
class BaseCollection implements Countable
{
    /**
     * Array of typed result objects.
     * @var array
     */
    public $items = [];

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
     * Convert collection to string
     * @return string
     */
    public function __toString(): string
    {
        return print_r($this->items, true);
    }


    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return $this->count;
    }

    /**
     * Get object in the collection by id
     * @param string $id
     * @return mixed|null
     */
    public function get($id)
    {
        foreach ($this->items as $item) {
            if ($item->id === $id) {
                return $item;
            }
        }
        return null;
    }
}
