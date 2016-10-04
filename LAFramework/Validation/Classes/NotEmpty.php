<?php

namespace LAFramework\Validation\Classes;

/**
 * class for validation
 */
class NotEmpty implements IValid {
    
    /**
     * 
     * @param mixin $var
     * @param string $key
     * @param array $option
     * @return array
     */
    public function validate($var, $key, $option = null) {
        
        if (empty($var)) {
            return ['success' => false, 'error' => "{$key} is not empty"];
        }
        
        return ['success' => true];
    }
    
}