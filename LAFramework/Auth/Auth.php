<?php
 
namespace LAFramework\Auth;


use LAFramework\Session\Session;
use LAFramework\HttpFoundation\Request;
use LAFramework\Auth\IAuthHandler;
use LAFramework\Auth\IPassCrypt;


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
     * @var \LAFramework\Auth\IAuthHandler
     */
    private $authHandler;
    /**
     *
     * @var \LAFramework\Auth\IPassCrypt
     */
    private $passCrypt;
    
    /**
     * 
     * @param Session $session
     * @param Request $request
     */
    public function __construct(Session $session, Request $request, IAuthHandler $authHandler, IPassCrypt $passCrypt) {
        $this->session = $session;
        $this->request = $request;
        
        $this->authHandler = $authHandler;
        $this->passCrypt = $passCrypt;
                
    }
    
    public function isAuth() {
        
    }
    
    public function getUser() {
        
    }
    
    public function auth() {
        
    }
    
    public function loguot() {
        $this->session->stop();
    }
    

}