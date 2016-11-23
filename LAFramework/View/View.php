<?php

namespace LAFramework\View;

use LAFramework\Container\Container;

/**
 * class for display tamplate
 */
class View {
    
    /**
     *
     * @var string
     */
    private $templatePath;
    /**
     *
     * @var string
     */
    private $baseTmpl;
    /**
     *
     * @var string
     */
    private $title;
    /**
     *
     * @var array
     */
    private $data = [];


    /**
     * 
     * @param string $templatePath
     * @param string $baseTmpl
     */
    public function __construct($templatePath, $baseTmpl) {
        
        $this->templatePath = $templatePath;
        
        $this->baseTmpl = $baseTmpl;
        
    }
    
    /**
     * 
     * @param array $data
     */
    public function assignVars($data) {
        
        $this->data = array_merge($this->data, $data);
        
    }
    
    /**
     * 
     * @param string $title
     */
    public function setTitle($title = 'main') {
        
        $this->title = $title;
        
    }


    /**
     * 
     * @param string $view
     * @param bool $nowrap
     * @return string
     */
    public function render($view, $nowrap = false) {
        
        $container = Container::init();
        
        extract($this->data);

        ob_start();
        
        include_once $this->templatePath . $view . '.php';
        
        $content = ob_get_clean();
        
        if ($nowrap) {
            return $content;
        }

        ob_start();        
        
        $title = $this->title;
        
        include_once $this->templatePath . $this->baseTmpl . '.php';
        
        $result = ob_get_clean();
        
        return $result;
        
    }    
    
}