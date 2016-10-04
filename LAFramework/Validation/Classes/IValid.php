<?php

namespace LAFramework\Validation\Classes;

/**
 * interface for validation
 */
interface IValid {
     
    /**
     * 
     * @param mixin $var
     * @param string $key
     * @param array $option
     * @return array
     */
    public function validate($var, $key, $option = null); 
    
}