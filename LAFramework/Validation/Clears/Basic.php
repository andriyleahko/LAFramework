<?php

namespace LAFramework\Validation\Clears;

/**
 * class for validation
 */
class Basic implements IClear {
    
    /**
     * 
     * @param string $var
     * @return string
     */
    public function clear($var) {
        
        return trim(strip_tags($var));
    }
    
}