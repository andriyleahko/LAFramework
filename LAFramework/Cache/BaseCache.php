<?php

namespace LAFramework\Cache;

use LAFramework\Cache\ICache;

/**
 * base class for all type caching
 */
class BaseCache {

    /**
     *
     * @var object 
     */
    public $adapter;

    /**
     * 
     * @param ICache $adapter
     */
    public function __construct(ICache $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * 
     * @param string $key
     * @param string $value
     */
    public function set($key, $value) {
        $this->adapter->set($key, $value);
    }

    /**
     * 
     * @param string $key
     * @return array | object
     */
    public function get($key) {
        return $this->adapter->get($key);
    }

}
