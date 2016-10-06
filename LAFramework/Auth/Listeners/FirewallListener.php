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
     * @param string $uri
     */
    public function ifRequestAuth($uri) {
        
        if ($uri == $this->firewall->paths['login']) {
            $this->firewall->auth->auth();
        }
        
        if ($uri == $this->firewall->paths['logout']) {
            $this->firewall->auth->logout();
        } 
        
    }
    /**
     * 
     * @param array $data
     */
    public function firewallProcess($data) {
        
        /**
         * @todo check rule for route
         */
        
    }
    
    
}