<?php

namespace SecucardConnect\Client;

class FileStorage extends DummyStorage {
    
    public function __construct($file) {
        // init dummy storage var
        $this->storage = array();
        
        $this->file = $file;
    }
    
    /**
     * Retrieve an item from cache
     *
     * @param string $key The key to store it under
     * @return mixed
     */
    public function get($key) {
        $this->load();
        
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
     * @return bool
     */
    public function set($key, $value) {
        $this->load();
        $this->storage[$key] = $value;
        return $this->save();
    }

    /**
     * Remove a key from the cache.
     *
     * @param string $key
     * @return bool
     */
    public function delete($key) {
        $this->load();
        unset($this->storage[$key]);
        return $this->save();
    }

    /**
     * Remove all items from the cache (flush it).
     *
     * @return bool
     */
    public function deleteAll() {
        $this->load();
        $this->storage = array();
        return $this->save();
    }
    
    
    private function load() {
        $data = @file_get_contents($this->file);
        if ($data) {
            $this->storage = json_decode($data, TRUE);
            return true;
        }
       return false;
    }
    
    private function save() {
        file_put_contents($this->file, json_encode($this->storage));
        return true;
    }
} 