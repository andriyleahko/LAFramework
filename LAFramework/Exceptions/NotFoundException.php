<?php 

namespace LAFramework\Exceptions;

use LAFramework\Container\Container;
use LAFramework\Container\Config;

class NotFoundException extends \Exception implements IError  {
    
    /**
     *
     * @var Container 
     */
    private $container;
    
    /**
     * 
     * @param string $message
     * @param string $code
     * @param string $previous
     */
    public function __construct($message, $code = null, $previous = null) {
        $this->container = Container::init();
        parent::__construct($message, $code, $previous);
    }
    
    public function genereError() {
       
        $data = ['message' => $this->message, 'code' => $this->code];
        
        if ($this->container->get('request')->isAjax()) {
            $this->container->get('response')->setJsonResponse($data);
        } else {
            $this->container->get('view')->assignVars($data);
            $this->container->get('response')->setHtmlResponse($this->container->get('view')->render(Config::getParam('tpl404')));
        }
        
    }
    
}