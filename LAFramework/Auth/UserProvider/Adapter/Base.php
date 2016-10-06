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
    
    public function getUserByEmail() {
        ;
    }
    
    
}