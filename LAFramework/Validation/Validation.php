<?php

namespace LAFramework\Validation;

use LAFramework\Validation\Classes\IValid;
use LAFramework\Validation\Clears\IClear;

/**
 * class for validation
 */
class Validation {
    
    
    /**
     *
     * @var array 
     */
    private $errors = [];
    
    /**
     *
     * @var array 
     */
    private $vars;
    
    /**
     *
     * @var array 
     */
    private $rules;
    
    /**
     *
     * @var array 
     */
    private $clearRules;
    
    /**
     *
     * @var array 
     */
    private $clearClasses;
    
    /**
     *
     * @var array 
     */
    private $clearCustomClasses;
    
    /**
     *
     * @var array 
     */
    private $clearObjects;
    
    /**
     *
     * @var array 
     */
    private $validationClasses;
    
    /**
     *
     * @var array 
     */
    private $validationObjects;
    
    /**
     *
     * @var array 
     */
    private $customValidationClasses;


    /**
     * 
     * @param array $validationClasses
     * @param array $customValidationClasses
     * @param array $clearClasses
     * @param array $clearCustomClasses
     */
    public function __construct($validationClasses, $customValidationClasses, $clearClasses, $clearCustomClasses) {
        
        $this->validationClasses = $validationClasses;
        $this->customValidationClasses = $customValidationClasses;
        
        foreach ($this->validationClasses as $key => $classes) {
            if ($classes instanceof IValid) {
                $this->validationObjects[$key] = new $classes;
            }
        }
        
        if (is_array($this->customValidationClasses)) {
            foreach ($this->customValidationClasses as $key => $classes) {
                if ($classes instanceof IValid) {
                    $this->validationObjects[$key] = new $classes;
                }
                
            }
        }
        
        $this->clearClasses = $clearClasses;
        $this->clearCustomClasses = $clearCustomClasses;
        
        foreach ($this->clearClasses as $key => $classes) {
            if ($classes instanceof IClear) {
                $this->clearObjects[$key] = new $classes;
            }
        }
        
        if (is_array($this->clearCustomClasses)) {
            foreach ($this->clearCustomClasses as $key => $classes) {
                if ($classes instanceof IClear) {
                    $this->clearObjects[$key] = new $classes;
                }
                
            }
        }
                
    }
    
    /**
     * 
     * @param array $vars
     */
    public function setVars($vars) {
        
        $this->vars = $vars;
        
    }
    
    /**
     * 
     * @param array $rule
     */
    public function setRule($rule) {
        
        $this->rule = $rule;
    }

    /**
     * 
     * @param array $rule
     */
    public function clearRule($rule) {
        
        $this->clearRule = $rule;
          
    }

    public function validate() {
        
        if (count($this->vars)) {
            foreach ($this->vars as $key => $var) {
                $rules = $this->rules[$key];
                $clears = $this->clearRules[$key];
                
                if (count($rules) > 0) {
                    foreach ($rules as $rule) {
                        $option = null;
                        if (is_array($rule)) {
                            foreach ($rule as $k => $v) {
                                $rule = $k;
                                $option = $v;
                                break;
                            }
                        }
                        $validData = $this->validationObjects[$rule]->validate($var, $key, $option);
                        if (!$validData['success']) {
                            $this->errors[$key] = $validData['error'];
                        }
                    }
                }
                
                if (count($clears)) {
                    foreach ($clears as $clr) {
                        $this->vars[$key] = $this->clearObjects[$clr]->clear($var);
                    }
                }

            }
        }
        
    }
    
    /**
     * 
     * @return array
     */
    public function getErrors() {
        
        return $this->errors;
        
    }
    
    /**
     * 
     * @param string $key
     * @return mixin
     */
    public function getVar($key) {
        
        return $this->vars[$key];
    }
    
    /**
     * 
     * @return array
     */
    public function getVars() {
        return $this->vars;
    }
    
    
    
}