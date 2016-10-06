<?php
 
namespace LAFramework\Auth\UserProvider;

use LAFramework\Auth\UserProvider\Adapter\IProvider;

class BaseProvider {
    
    /**
     *
     * @var \LAFramework\Auth\UserProvider\Adapter\IProvider 
     */
    private $adapter;


    /**
     * 
     * @param IProvider $adapter
     */
    public function __construct(IProvider $adapter) {
        $this->adapter = $adapter;
    }
    
    public function getUserByEmail() {
        ;
    }
    
    
}