<?php

namespace SecucardConnect\Client;

class DummyStorage implements StorageInterface {
    
    protected $storage;
    
    public function __construct() {
        // init dummy storage var
        $this->storage = array();
    }
    
    /**
     * Retrieve an item from cache
     *
     * @param string $key The key to store it under
     * @return mixed
     */
    public function get($key) {
        if (isset($this->storage[$key])) {
            return $this->storage[$key];
        }
        return false;
    }

    /**
     * Set an item in the cache
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value) {
        $this->storage[$key] = $value;
    }

    /**
     * Remove a key from the cache.
     *
     * @param string $key
     * @return void
     */
    public function delete($key) {
        unset($this->storage[$key]);
    }

    /**
     * Remove all items from the cache (flush it).
     *
     * @return void
     */
    public function deleteAll() {
        $this->storage = array();
    }
} 