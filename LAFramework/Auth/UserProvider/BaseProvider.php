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
    
    /**
     * 
     * @param string $user
     * @return array | null
     */
    public function getUserByEmail($user) {
        return $this->adapter->getUserByEmail($user);
    }
    
    
}