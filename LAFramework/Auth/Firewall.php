<?php

namespace LAFramework\Auth;

use LAFramework\Auth\Auth;

class Firewall {
    
    /**
     * @var array 
     */
    public $rules;
    
    /**
     * @var array 
     */
    public $roles;
    
    /**
     * @var array 
     */
    public $paths;
    
    /**
     * @var \LAFramework\Auth\Auth 
     */
    public $auth;
    
    /**
     * 
     * @param array $rules
     * @param array $roles
     * @param array $paths
     */
    public function __construct($rules, $roles, $paths, Auth $auth) {
        
        $this->rules = $rules;
        
        $this->roles = $roles;
        
        $this->paths = $paths;
        
        $this->auth = $auth;
        
    }
    
    
}