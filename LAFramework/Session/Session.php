<?php

namespace LAFramework\Session\Session;

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
    
    public function setData($key, $value) {
        
    }
    
    public function getData($key) {
        
    }
    
    public function getAll() {
        
    }
    
}