<?php
 
namespace LAFramework\Auth;


use LAFramework\Session\Session;
use LAFramework\HttpFoundation\Request;
use LAFramework\Auth\IAuthHandler;
use LAFramework\Auth\IPassCrypt;
use LAFramework\Auth\UserProvider\BaseProvider;


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
     * @var \LAFramework\Auth\UserProvider\BaseProvider
     */
    private $baseAuthProvider;
    
    /**
     * 
     * @param Session $session
     * @param Request $request
     */
    public function __construct(Session $session, Request $request, IAuthHandler $authHandler, IPassCrypt $passCrypt, BaseProvider $baseAuthProvider) {
        $this->session = $session;
        $this->request = $request;
        
        $this->authHandler = $authHandler;
        $this->passCrypt = $passCrypt;
        $this->baseAuthProvider = $baseAuthProvider;
                
    }
    
    public function isAuth() {
        
        return $this->session->getData('user');
        
    }
    
    /**
     * 
     * @return array
     */
    public function getAuthUser() {
        
        return $this->session->getData('user');
        
    }
    
    /**
     * 
     * @return bool
     */
    public function auth() {
        
        if ($this->isAuth()) {
            $this->authHandler->onUserIsAuth();
        }
        
        if ($this->request->isPost() and $this->request->getPost('username') and $this->request->getPost('pass')) {
            
            $user = $this->baseAuthProvider->getUserByEmail($this->request->getPost('username'));
            
            if ($user and $user['pass'] == $this->passCrypt->crypt($this->request->getPost('pass'))) {
               $this->session->setData('isAuth', 1);
               $this->session->setData('user', $user);
               $this->authHandler->onSuccess(); 
            } else {
               $this->authHandler->onFail('Bad credential'); 
            }
            
        }
        
        return;
        
    }
    

    /**
     * @return bool
     */
    public function loguot() {
        return $this->session->stop();
    }
    

}