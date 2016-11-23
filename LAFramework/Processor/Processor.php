<?php

namespace LAFramework\Processor;

use LAFramework\Router\Route;
use LAFramework\Session\Session;
use LAFramework\HttpFoundation\Request;
use LAFramework\HttpFoundation\Response;
use LAFramework\Dispatcher\Dispatcher;
use LAFramework\Exceptions\NotFoundException;

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
     * @var \LAFramework\HttpFoundation\Response
     */
    private $response;
    
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
    public function __construct(Route $route, Request $request, Session $session, Dispatcher $dispatcher, Response $response) {
        $this->route = $route;
        $this->request = $request;
        $this->response = $response;
        $this->session = $session;
        $this->dispatcher = $dispatcher;
        
        $this->session->start();
    }
    
    /**
     * main method for resolve browser request
     * @throws \Exception
     */
    public function resolve() {
        
        $this->dispatcher->dispatch('ifRequest', $this->request->getServerData('REQUEST_URI'));
        
        if ($this->response->isResponse()) {
            return;
        }
        
        $data = $this->route->resolveRoute();
        
        $controllerData = $data['controllerData'];
        $controllerKey = $data['routeKey'];
        
        if (!$controllerData) {
            throw new NotFoundException('route is not exists');
        }
        
        if (!class_exists($controllerData['controller'])) {
            throw new NotFoundException("class for route {$controllerKey} is not exists");
        }
        
        $this->dispatcher->dispatch('firewallProcess', $data);
        
        $instance = new $controllerData['controller']();
        
        if ($this->response->isResponse()) {
            return;
        }
        
        if (!method_exists($instance, $controllerData['method'])) {
            throw new NotFoundException("method for route {$controllerKey} is not exists");
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
            throw new NotFoundException("mising route params");
        }
        
        
        foreach ($paramsMethod as $mParam) {
            if (!in_array($mParam->name, $paramsRoute)) {
                throw new NotFoundException("param {$mParam->name} in route {$controllerKey} not exists");
            }
        }
        
        call_user_func_array(array($instance, $controllerData['method']), $arrParamValue);
           
        
    }
    
    
    
    
    
}

