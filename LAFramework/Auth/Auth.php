<?php
 
namespace LAFramework\Auth;


use LAFramework\Session\Session;
use LAFramework\HttpFoundation\Request;


class Auth {
    
    /**
     *
     * @var \LAFramework\Session\Session 
     */
    private $session;
    /**
     *
     * @var \LAFramework\HttpFoundation\Request
     */
    private $request;
    
    /**
     * 
     * @param Session $session
     * @param Request $request
     */
    public function __construct(Session $session, Request $request) {
        $this->session = $session;
        $this->request = $request;
                
    }
    
    public function isAuth() {
        
    }
    
    public function getUser() {
        
    }
    
    public function auth() {
        
    }
    

}