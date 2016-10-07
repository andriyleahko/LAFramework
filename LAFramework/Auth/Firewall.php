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
    
    /**
     * 
     * @param array $data
     */
    public function checkRule($data) {
        
        $roleRoute = $data['controllerData']['role'];
        
        $denied = (isset($roleRoute['denied'])) ? $roleRoute['denied'] : null; 
        $allow = (isset($roleRoute['allow'])) ? $roleRoute['allow'] : null; 
        
        if (!$allow and !$denied) {
            return;
        }
        
        if (!$this->auth->isAuth()) {
            $userRole = [];
        }
        
        if (($this->auth->getAuthUser() and !isset($this->auth->getAuthUser()['role'])) 
                or ($this->auth->getAuthUser() and isset($this->auth->getAuthUser()['role']) and $this->auth->getAuthUser()['role'] == null)
                    or ($this->auth->getAuthUser() and isset($this->auth->getAuthUser()['role']) and is_array($this->auth->getAuthUser()['role']) and count($this->auth->getAuthUser()['role']) == 0)) {
            $userRole = ['User'];
        }
        
        if ($this->auth->getAuthUser() and isset($this->auth->getAuthUser()['role']) and is_array($this->auth->getAuthUser()['role'])) {
            $userRole = $this->auth->getAuthUser()['role'];
        }
        
        $userRole[] = 'Anonim';
        
        if (is_array($allow)) {
            foreach ($userRole as $ur) {
                if (in_array($ur, $userRole)) {
                    return;
                }
            }
            
            throw new \Exception('you have not rule for run this route');
        }
        
        if (is_array($denied)) {
            foreach ($userRole as $ur) {
                if (in_array($ur, $userRole)) {
                    throw new \Exception('you have not rule for run this route');
                }
            }
        }
        
        return;
        
        
    }
    
    
}