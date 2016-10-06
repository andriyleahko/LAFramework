<?php
 
namespace LAFramework\Auth\UserProvider\Adapter;



class Data implements IProvider {
    
    /**
     *
     * @var array 
     */
    private $data;


    /**
     * 
     * @param array $data
     */
    public function __construct(array $data) {
        $this->data = $data;
    }
    
    public function getUserByEmail() {
        ;
    }
    
    
}