<?php
 
namespace LAFramework\Auth\UserProvider\Adapter;

interface IProvider {
    
    /**
     * 
     * @param string $user
     * @return array $user | null
     */
    public function getUserByEmail($user);
    
    /**
     * 
     * @param string $token
     */
    public function getUserByToken($token);
    
}