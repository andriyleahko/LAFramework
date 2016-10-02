<?php 

namespace LAFramework\Cache\Adapter;

use LAFramework\Cache\ICache;

/**
 * class for caching to file
 */
class FileCache implements ICache {
    
    /**
     *
     * @var string 
     */
    public $path;
    
    /**
     * 
     * @param string $path
     */
    public function __construct($path) {
        $this->path = $path;
    }
    
    /**
     * 
     * @param string $key
     * @return array | object
     */
    public function get($key) {
        if (file_exists($this->path . '/' . md5($key))) {
            return unserialize(file_get_contents($this->path . '/' . md5($key)));
        }
    }
    
    /**
     * 
     * @param string $key
     * @param string $value
     */
    public function set($key, $value) {
        file_put_contents($this->path . '/' . md5($key), serialize($value));
    }
    
    
    
}