<?php 

namespace LAFramework\Exceptions;

use LAFramework\Container\Container;

class NotAuthException extends \Exception implements IError  {
    
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
    public function __construct($message = null, $code = null, $previous = null) {
        $this->container = Container::init();
        parent::__construct($message, $code, $previous);
    }
    
    public function genereError() {
        
        if ($this->container->get('request')->isAjax()) {
            $this->container->get('response')->setJsonResponse(['message' => 'You do not auth']);
        } else {
            $this->container->get('response')->setRedirectResponse($this->container->get('firewall')->paths['login_form']);
        }
        
    }
    
}