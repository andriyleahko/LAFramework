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
    
    /**
     * 
     * @param string $user
     * @return null | array $user
     */
    public function getUserByEmail($user) {
        
        foreach ($this->data as $dataUser) {
            
            if ($dataUser['username'] == $user) {
                return $dataUser;
            }
        }
        
        return null;
    }
    
    
}