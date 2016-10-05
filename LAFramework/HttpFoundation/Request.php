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
        
        return (count($_POST) > 0);
        
    }
    
    /**
     * @return bool
     */
    public function isAjax() {
        
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
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

