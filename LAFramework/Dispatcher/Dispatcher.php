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
        
        $eventsMerge = array_merge($events, $baseEvents);
        
        $this->events = [];
        if (count($eventsMerge)) {
            foreach ($eventsMerge as $event) {
                $this->events[$event['key']][] = $event;
            }
        }
        
        
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
            
            foreach ($this->events[$key] as $event) {
                
                $component = $event['component'];

                $componentEntity = $this->container->get($component);

                if (!method_exists($componentEntity, $event['method'])) {
                    throw new \Exception('Method in listener does not found!');
                }

                $componentEntity->{$event['method']}($data);
            }
                
        }
    }
    
}


