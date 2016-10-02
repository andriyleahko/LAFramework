<?php

namespace LAFramework\HttpFoundation;


/**
 * class for filtering request params
 */
class Request {
    


    public function __construct() {

    }
    
    /**
     * 
     * @param string $key
     * @return string | other
     */
    public function getPost($key = null) {
        /**
         * @todo filtered
         */
        return ($key) ? $_POST[$key] : $_POST;
    }
    
    /**
     * 
     * @param string $key
     * @return string | other
     */
    public function getGet($key = null) {
        /**
         * @todo filtered
         */
        return ($key) ? $_GET[$key] : $_GET;
    }
    
    /**
     * @return bool
     */
    public function isPost() {
        
        /**
         * @todo
         */
        
    }
    
    /**
     * @return bool
     */
    public function isAjax() {
        /**
         * @todo
         */
    }
    
    /**
     * 
     * @param string $key
     * @return string | other
     */
    public function getServerData($key) {
        
        return ($key) ? $_SERVER[$key] : $_SERVER;
        
    }
    
    

    
    
    
    
    
}

