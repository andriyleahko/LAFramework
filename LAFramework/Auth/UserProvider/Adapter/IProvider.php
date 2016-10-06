<?php
 
namespace LAFramework\Auth\UserProvider\Adapter;

interface IProvider {
    
    /**
     * 
     * @param string $user
     * @return array $user | null
     */
    public function getUserByEmail($user);
    
}