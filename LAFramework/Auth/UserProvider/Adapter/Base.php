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
     * @return null | array $user
     */
    public function getUserByEmail($user) {
        $user = $this->doctrine->getEntityManager()->getRepository($this->table)->findOneBy(['username' => $user]);
        
        if ($user) {
            
            return [
                'username' => $user->getUsername(),
                'pass' => $user->getPass(),
                'roles' => $user->getRoles(),
                'userObject' => $user
            ];
            
        } 
        
        return null;
    }
    
    
}