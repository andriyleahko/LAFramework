<?php

namespace LAFramework\Auth\Listeners;

use LAFramework\Auth\Firewall;

class FirewallListener {
    
    /**
     *
     * @var \LAFramework\Auth\Firewall
     */
    private $firewall;
    
    
    /**
     * 
     * @param Firewall $firewall
     */
    public function __construct(Firewall $firewall) {
        $this->firewall = $firewall;
    }
    
    /**
     * 
     * @param array $data
     */
    public function onRequest($data) {
        
        dump($data);
        dump($this->firewall);
        
        
    }
    
    
}