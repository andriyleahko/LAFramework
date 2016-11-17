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
     * @var array | bool 
     */
    private $user = false;


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
        
        $this->user = $this->session->getData('user');
                
    }
    
    public function isAuth() {
        
        return ($this->user !== false);
        
    }
    
    /**
     * 
     * @param array $user
     */
    public function setUser($user) {
        
        $this->user = $user;
        
    }

        /**
     * 
     * @return array
     */
    public function getAuthUser() {
        
        return $this->user;
        
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
            'username' => ['notEmpty','length' => ['min' => 3, 'max' => 200], 'email'],
            'pass' => ['notEmpty','length' => ['min' => 3, 'max' => 200]],
            '_csrf' => ['csrf','notEmpty']
        ]);
        
        $this->validation->clearRule([
            'username' => ['basic'],
            'pass' => ['basic'],
        ]);
        
        $this->validation->validate();
        
        if (count($this->validation->getErrors()) == 0) {
            
            $user = $this->baseAuthProvider->getUserByEmail($this->validation->getVar('username'));
            
            if ($user and $user->getPass() == $this->passCrypt->crypt($this->validation->getVar('pass'))) {
                if ($user->getResettingToken()) {
                    $this->authHandler->onFail('User is blocked'); 
                } else {
                     $this->session->setData('user', $user);
                     $this->user = $user;
                    $this->authHandler->onSuccess(); 
                }
            } else {
               $this->authHandler->onFail('Bad credential'); 
            }
            
        } else {
            $this->authHandler->onFail(implode(', ', $this->validation->getErrors()));
        }
        
        return;
        
    }
    
    /**
     * 
     * @param \LAFramework\Auth\LAFramework\Auth\Model\IUser $user
     * @param string $pass
     */
    public function changePassword(LAFramework\Auth\Model\IUser $user, $pass) {
        
        $user->setPass($this->passCrypt->crypt($pass));
    }
    
    /**
     * 
     * @param string $token
     * @return null | object
     */
    public function resetPassword($token) {
        
        $user = $this->baseAuthProvider->getUserByToken($token);
        
        return ($user) ? $user : null;
        
    }

        /**
     * @return bool
     */
    public function logout() {
        return $this->session->stop();
    }
    

}