<?php

namespace LAFramework\Validation\Classes;

/**
 * class for validation
 */
class Length implements IValid {
    
    /**
     * 
     * @param mixin $var
     * @param string $key
     * @param array $option
     * @return array
     */
    public function validate($var, $key, $option = null) {
        
        if ($option) {
            if (isset($option['min']) or isset($option['max'])) {
                if (isset($option['min']) and strlen($var) < $option['min']) {
                    return ['success' => false, 'error' => "min length {$key} must be {$option['min']}"];
                }
                if (isset($option['max']) and strlen($var) > $option['max']) {
                    return ['success' => false, 'error' => "max length {$key} must be {$option['max']}"];
                }
            }
        } 
        
        return ['success' => true];
        
    }
    
}