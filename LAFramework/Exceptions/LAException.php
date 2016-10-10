<?php 

namespace LAFramework\Exceptions;

use LAFramework\Container\Container;

class LAException {
    
    /**
     * 
     * @param \Exception $ex
     * @return type
     */
    public function __construct(\Exception $ex) {
        
        $container = Container::init();
        
        if (method_exists($ex, 'genereError')) {
            $ex->genereError();
        } else {
            $data = ['error' => $ex];
        
            if ($container->get('request')->isAjax()) {
                $container->get('response')->setJsonResponse($data);
            } else {
                $container->get('view')->assignVars($data);
                $container->get('response')->setHtmlResponse($container->get('view')->render(Config::getParam('customErr')));
            }
        }
        
    }
    
    
    
}