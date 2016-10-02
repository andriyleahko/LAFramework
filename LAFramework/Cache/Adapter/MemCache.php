<?php

namespace LAFramework\Cache\Adapter;

use LAFramework\Cache\ICache;

/**
 * class for caching data to memcache
 * must be install memcached extension and memcached server
 */
class MemCache implements ICache {

    /**
     *
     * @var string 
     */
    private $host;
    /**
     *
     * @var string 
     */
    private $port;
    /**
     *
     * @var object
     */
    private $memcache;

    /**
     * 
     * @param string $host
     * @param string $port
     * @throws Exception
     */
    public function __construct($host, $port) {

        $this->host = $host;

        $this->port = $port;

        $this->memcache = new \Memcache();

        if (!$this->memcache->connect($this->host, $this->port)) {
            throw new Exception('memcache does not work');
        }
    }

    /**
     * 
     * @param string $key
     * @return array | object
     */
    public function get($key) {

        return unserialize($this->memcache->get($key));
    }

    /**
     * 
     * @param string $key
     * @param string $value
     */
    public function set($key, $value) {

        $this->memcache->set($key, serialize($value));
    }

}
