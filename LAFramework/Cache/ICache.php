<?php 

namespace LAFramework\Cache;

/**
 * interface for all caching adapter
 */
interface ICache {
    
    /**
     * 
     * @param string $key
     * @param string $value
     */
    public function set($key, $value);

    /**
     * 
     * @param string $key
     */
    public function get($key);

}
