<?php 

namespace LAFramework\Auth\Model;

interface IUser {
    
    public function getUsername();

    /**
     * 
     * @param string $username
     */
    public function setUsername($username);
    
    public function getFirstName();

    /**
     * 
     * @param string $firstname
     */
    public function setFirstName($firstname);
    
    public function getLastName();

    /**
     * 
     * @param string $lastname
     */
    public function setLastName($lastname);

    public function getPass();

    /**
     * 
     * @param string $pass
     */
    public function setPass($pass);
    
    public function getEnabled();

    /**
     * 
     * @param int $en
     */
    public function setEnabled($en);
    
    public function getResettingToken();

    /**
     * 
     * @param string $reseting_token
     */
    public function setResettingToken($reseting_token);

    public function getRoles();

    /**
     * 
     * @param array $roles
     */
    public function setRoles($roles);
    
    
    
    
    
}