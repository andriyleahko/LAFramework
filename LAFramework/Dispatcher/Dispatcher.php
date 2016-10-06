<?php

namespace LAFramework\Dispatcher;

use LAFramework\Container\Container;

/**
 * dispatcher event
 */
class Dispatcher {
    
    /**
     * all event and listeners
     * @var array 
     */
    public $events;
    /**
     * all event and listeners
     * @var array 
     */
    public $baseEvents;
    
    /**
     *
     * @var \Container\Container 
     */
    private $container;

    public function __construct($events, $baseEvents) {
        
        $this->baseEvents = $baseEvents;
        
        $this->events = array_merge($events, $baseEvents);
        
        
        $this->container = Container::init();
        
    }
    
    
    /**
     * 
     * @param string $key
     * @param string $data
     * @throws \Exception
     */
    public function dispatch($key, $data) {
        
        if (array_key_exists($key, $this->events)) {
                
            $component = $this->events[$key]['component'];

            $componentEntity = $this->container->get($component);

            if (!method_exists($componentEntity, $this->events[$key]['method'])) {
                throw new \Exception('Method in listener does not found!');
            }

            $componentEntity->{$this->events[$key]['method']}($data);
                
        }
    }
    
}


