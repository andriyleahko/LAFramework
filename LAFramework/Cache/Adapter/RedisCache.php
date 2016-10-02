<?php 

namespace LAFramework\Cache\Adapter;

use LAFramework\Cache\ICache;

/**
 * class for caching data to redis
 * must be install redis extension and redis server
 */
class RedisCache implements ICache {
    
    /**
     *
     * @var string 
     */
    public $host;
    /**
     *
     * @var string 
     */
    public $port;
    /**
     *
     * @var string 
     */
    public $pass;
    /**
     *
     * @var object 
     */
    private $redis;
    
    
    /**
     * 
     * @param string $host
     * @param string $port
     * @param string $pass
     */
    public function __construct($host, $port, $pass) {
        $this->host = $host;
        $this->port = $port;
        $this->pass = $pass;
        
        $this->redis = new \Redis();
        $this->redis->connect($this->host,  $this->port);
        $this->redis->auth($this->pass);
    }
    
    /**
     * 
     * @param string $key
     * @return array | object
     */
    public function get($key) {
        return $this->redis->get($key);
    }
    
    /**
     * 
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set($key, $value) {
        return $this->redis->set($key, $value);
    }
    
    
    
}