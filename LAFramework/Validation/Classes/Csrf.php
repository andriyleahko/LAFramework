<?php

namespace LAFramework\Validation\Classes;

use LAFramework\Container\Container;
/**
 * class for validation
 */
class Csrf implements IValid {
    
    

    /**
     * 
     * @param mixin $var
     * @param string $key
     * @param array $option
     * @return array
     */
    public function validate($var, $key, $option = null) {
        
        if ($key != '_csrf') {
            return ['success' => false, 'error' => "csrf must be"];
        }
        
        $container = Container::init();
        
        $session = $container->get('session');
        
        if ($var != $session->getCSRF()) {
            return ['success' => false, 'error' => "csrf is not match"];
        }
        
        $session->genereCSRF();
        
        return ['success' => true];
    }
    
}