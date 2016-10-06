<?php

namespace LAFramework\Auth;

interface IPassCrypt {
    
    /**
     * 
     * @param string $pass
     * @reyurn string
     */
    public function crypt($pass);
    
}