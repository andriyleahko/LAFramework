<?php

namespace LAFramework\Router;

use LAFramework\HttpFoundation\Request;

/**
 * class for routing
 */
class Route {
    
    /**
     *
     * @var array 
     */
    private $routelist;
    
    /**
     *
     * @var \HttpFoundation\Request 
     */
    private $request;
    
    /**
     * 
     * @param Request $request
     */
    public function __construct(Request $request) {
        
        $this->request = $request;
        
        $this->routelist = include 'config/routing/route.php';
    }
    
    /**
     * 
     * @return arry
     */
    public function getRoute() {
        return $this->routelist;
    }
    
    /**
     * 
     * @return array data current route param
     */
    public function resolveRoute() {
        
        $controllerKey = null;
        $controllerData = null;
        foreach ($this->getRoute() as $key => $route) {
            $arrRoute = explode('/', $route['url']);
            $arrReqAux = explode('/',$this->request->getServerData('REQUEST_URI'));

            $arrReq = array_splice($arrReqAux, 0, count($arrRoute));
            
            $requestUri = implode('/', $arrReq);
            
            if ($route['url'] == $requestUri) {
                $controllerData = $route;
                $controllerKey = $key;
                break;
            }
        }
        
        return ['controllerData' => $controllerData, 'routeKey' => $controllerKey];
        
    }
    
    /**
     * 
     * @param string $keyRoute
     * @param array $param
     * @return string
     * @throws \Exception
     */
    public function genereUrl($keyRoute, $param = null) {
        
        if (!array_key_exists($keyRoute, $this->routelist)) {
            throw new \Exception("route {$keyRoute} not found");
        }
        
        $route = $this->routelist[$keyRoute]; 
        
        if ($param) {
            
            $paramQuery = implode('/', $param); 
        
            return $route['url'] . '/' . $paramQuery;
            
        } else {
            
            return $route['url'];
            
        }
        
        
    }
    
    
}
