<?php

namespace LAFramework\Auth;

use LAFramework\Auth\Auth;
use LAFramework\Exceptions\DenyException;
use LAFramework\Exceptions\NotAuthException;

class Firewall {
    
    
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
    public function __construct($paths, Auth $auth) {
        
        $this->paths = $paths;
        
        $this->auth = $auth;
        
    }
    
    /**
     * 
     * @param array $data
     */
    public function checkRule($data) {
        
        if (!array_key_exists('role', $data['controllerData'])){
            return;
        }
        
        $roleRoute = $data['controllerData']['role'];
        
        $denied = (isset($roleRoute['denied'])) ? $roleRoute['denied'] : null; 
        $allow = (isset($roleRoute['allow'])) ? $roleRoute['allow'] : null; 
        

        
        if (!$allow and !$denied) {
            return;
        }
        
        if (!$this->auth->isAuth()) {
            $userRole = ['Anonim'];
        }
        
        if (!$this->auth->isAuth() and is_array($denied) and in_array('Anonim', $denied)) {
            throw new NotAuthException('you have not rule for run this route');
        }
        
        
        if (($this->auth->getAuthUser() and !$this->auth->getAuthUser()->getRoles()) 
                or ($this->auth->getAuthUser() and $this->auth->getAuthUser()->getRoles() and $this->auth->getAuthUser()->getRoles() == null)
                    or ($this->auth->getAuthUser() and $this->auth->getAuthUser()->getRoles() and is_array($this->auth->getAuthUser()->getRoles()) and count($this->auth->getAuthUser()->getRoles()) == 0)) {
            $userRole = ['User'];
        }
        
        if ($this->auth->getAuthUser() and $this->auth->getAuthUser()->getRoles() and is_array($this->auth->getAuthUser()->getRoles()) and count($this->auth->getAuthUser()->getRoles()) != 0) {
            $userRole = $this->auth->getAuthUser()->getRoles();
        }
        
             
        
        if (is_array($denied)) {
            foreach ($userRole as $ur) {
                if (in_array($ur, $denied)) {
                    throw new DenyException('you have not rule for run this route');
                }
            }
        }

        if (is_array($allow)) {
            foreach ($userRole as $ur) {
                if (in_array($ur, $allow)) {
                    return;
                }
            }
            
            throw new DenyException('you have not rule for run this route');
        }
        
        return;
        
        
    }
    
    
}