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
    
    /**
     * 
     */
    public function genereCSRF() {
        
        $_SESSION['csrf'] = md5('fasdf' . time() . 'sjdkleidn' . \LAFramework\Container\Config::getParam('salt'));
           
    }
    
    /**
     * 
     * @return string
     */
    public function getCSRF() {
        return (array_key_exists('csrf', $_SESSION)) ? $_SESSION['csrf'] : null;
    }
    
    /**
     * 
     * @param string $key
     * @param mixin $value
     */
    public function setFlush($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    /**
     * 
     * @param string $key
     * @return mixin
     */
    public function getFlush($key) {
        
        if (array_key_exists($key, $_SESSION)) {
            $res = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $res;
        }
        
        return null;
        
    }
    
}