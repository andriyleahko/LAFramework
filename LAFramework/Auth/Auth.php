<?php
 
namespace LAFramework\Auth;


use LAFramework\Session\Session;
use LAFramework\HttpFoundation\Request;
use LAFramework\Auth\IAuthHandler;
use LAFramework\Auth\IPassCrypt;
use LAFramework\Auth\UserProvider\BaseProvider;
use LAFramework\Validation\Validation;


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
     * @var \LAFramework\Validation\Validation
     */
    private $validation;
    
    /**
     * 
     * @param Session $session
     * @param Request $request
     */
    public function __construct(Session $session, Request $request, IAuthHandler $authHandler, IPassCrypt $passCrypt, BaseProvider $baseAuthProvider, Validation $validation) {
        $this->session = $session;
        $this->request = $request;
        
        $this->authHandler = $authHandler;
        $this->passCrypt = $passCrypt;
        $this->baseAuthProvider = $baseAuthProvider;
        $this->validation = $validation;
                
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
        
        if (!$this->request->isPost()) {
            $this->authHandler->onFail('Post is empty'); 
            
        }
        
        $this->validation->setVars($this->request->getPost());
        
        $this->validation->setRule([
            'username' => ['notEmpty','length' => ['min' => 3, 'max' => 20]],
            'pass' => ['notEmpty','length' => ['min' => 3, 'max' => 20]],
            '_csrf' => ['csrf','notEmpty']
        ]);
        
        $this->validation->clearRule([
            'username' => ['basic'],
            'pass' => ['basic'],
        ]);
        
        $this->validation->validate();
        
        if (count($this->validation->getErrors()) == 0) {
            
            $user = $this->baseAuthProvider->getUserByEmail($this->validation->getVar('username'));
            
            if ($user and $user['pass'] == $this->passCrypt->crypt($this->validation->getVar('pass'))) {
               $this->session->setData('isAuth', 1);
               $this->session->setData('user', $user);
               $this->authHandler->onSuccess(); 
            } else {
               $this->authHandler->onFail('Bad credential'); 
            }
            
        } else {
            $this->authHandler->onFail(implode(', ', $this->validation->getErrors()));
        }
        
        return;
        
    }
    

    /**
     * @return bool
     */
    public function logout() {
        return $this->session->stop();
    }
    

}