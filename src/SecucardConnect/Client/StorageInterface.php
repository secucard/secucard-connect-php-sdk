<?php

namespace SecucardConnect\Client;

interface StorageInterface {
    /**
     * Retrieve an item from cache
     *
     * @param string $key The key to store it under
     * @return mixed
     */
    function get($key);

    /**
     * Set an item in the cache
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    function set($key, $value);

    /**
     * Remove a key from the cache.
     *
     * @param string $key
     * @return void
     */
    function delete($key);

    /**
     * Remove all items from the cache (flush it).
     *
     * @return void
     */
    function deleteAll();
} 