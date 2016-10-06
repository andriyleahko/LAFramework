<?php

namespace LAFramework\Auth;

interface IAuthHandler {
    
    public function onSuccess();
    
    /**
     * 
     * @param string $message
     */
    public function onFail($message);
    
    public function onUserIsAuth();
    
}