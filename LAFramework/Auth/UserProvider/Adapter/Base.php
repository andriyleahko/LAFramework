<?php
 
namespace LAFramework\Auth\UserProvider\Adapter;

use LAFramework\Doctrine\Doctrine;

class Base implements IProvider {
    
    /**
     *
     * @var string 
     */
    private $table;
    
    /**
     *
     * @var \LAFramework\Doctrine\Doctrine 
     */
    private $doctrine;


    /**
     * 
     * @param type $table
     * @param Doctrine $doctrine
     */
    public function __construct($table, Doctrine $doctrine) {
        $this->table = $table;
        $this->doctrine = $doctrine;
    }
    
    /**
     * 
     * @param string $user
     * @return null | object $user
     */
    public function getUserByEmail($user) {
        $user = $this->doctrine->getEntityManager()->getRepository($this->table)->findOneBy(['username' => $user]);
        
        return ($user) ? $user : null;

    }
    
    /**
     * 
     * @param string $token
     * @return object | null
     */
    public function getUserByToken($token) {
        $user = $this->doctrine->getEntityManager()->getRepository($this->table)->findOneBy(['reseting_token' => $token]);
        
        return ($user) ? $user : null;
    }
    
    
    
}