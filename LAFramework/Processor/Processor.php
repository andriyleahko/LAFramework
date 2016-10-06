<?php

namespace LAFramework\Processor;

use LAFramework\Router\Route;
use LAFramework\Session\Session;
use LAFramework\HttpFoundation\Request;

/**
 * class for resolve browser request
 */
class Processor {
    
    /**
     *
     * @var \LAFramework\Router\Route 
     */
    private $route;
    
    /**
     *
     * @var \LAFramework\HttpFoundation\Request
     */
    private $request;
    
    /**
     *
     * @var \LAFramework\Session\Session
     */
    private $session;
    
    /**
     *
     * @var \LAFramework\Dispatcher\Dispatcher
     */
    private $dispatcher;
    


    /**
     * 
     * @param Route $route
     * @param Request $request
     */
    public function __construct(Route $route, Request $request, Session $session, Dispatcher $dispatcher) {
        $this->route = $route;
        $this->request = $request;
        $this->session = $session;
        $this->dispatcher = $dispatcher;
        
        $this->session->start();
    }
    
    /**
     * main method for resolve browser request
     * @throws \Exception
     */
    public function resolve() {
        
        $data = $this->route->resolveRoute();
        
        $this->dispatcher->dispatch('onRequest', $data);
        
        $controllerData = $data['controllerData'];
        $controllerKey = $data['routeKey'];
        
        if (!$controllerData) {
            throw new \Exception('route is not exists');
        }
        
        if (!class_exists($controllerData['controller'])) {
            throw new \Exception("class for route {$controllerKey} is not exists");
        }
        
        $instance = new $controllerData['controller']();
        
        if (!method_exists($instance, $controllerData['method'])) {
            throw new \Exception("method for route {$controllerKey} is not exists");
        }
        
        $reflectClass = new \ReflectionClass($controllerData['controller']);
        
        $paramsMethod = $reflectClass->getMethod($controllerData['method'])->getParameters();
        
        $paramsRoute = [];
        if (isset($controllerData['params'])) {
            $paramsRoute = explode('/', $controllerData['params']);
        }
        
        $arrParamValueAux = explode('/',ltrim(str_replace($controllerData['url'], '', $this->request->getServerData('REQUEST_URI')),'/'));
        $arrParamValue = array_filter($arrParamValueAux, function($value) { return $value !== ''; });
        

        if (count($paramsRoute) != count($paramsMethod) or count($arrParamValue) != count($paramsRoute) or count($arrParamValue) != count($paramsMethod)) {
            throw new \Exception("mising route params");
        }
        
        
        foreach ($paramsMethod as $mParam) {
            if (!in_array($mParam->name, $paramsRoute)) {
                throw new \Exception("param {$mParam->name} in route {$controllerKey} not exists");
            }
        }
        
        call_user_func_array(array($instance, $controllerData['method']), $arrParamValue);
           
        
    }
    
    
    
    
    
}

