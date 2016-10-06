<?php

namespace LAFramework\Session;

class Session {
    
    public function __construct() {
        ;
    }
    
    public function start() {
        session_start();
    }
    
    public function stop() {
        session_destroy();
    }
    
    /**
     * 
     * @param string $key
     * @param string $value
     */
    public function setData($key, $value) {
        
        $_SESSION[$key] = $value; 
        
    }
    
    /**
     * 
     * @param string $key
     * @return mixed
     */
    public function getData($key) {
        
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : false; 
        
    }
    
    /**
     * 
     * @return array
     */
    public function getAll() {
        
        return $_SESSION;
        
    }
    
}