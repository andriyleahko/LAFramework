<?php

namespace LAFramework\Validation\Classes;

/**
 * class for validation
 */
class Email implements IValid {
    
    /**
     * 
     * @param mixin $var
     * @param string $key
     * @param array $option
     * @return array
     */
    public function validate($var, $key, $option = null) {
        
        if (!filter_var($var, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'error' => "{$key} is not valid email"];
        }
        
        return ['success' => true];
    }
    
}