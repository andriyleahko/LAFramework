<?php

namespace LAFramework\HttpFoundation;


/**
 * class for response
 */
class Response {
    
    const JSONTYPE = 1;
    const HTMLTYPE = 2;

    /**
     *
     * @var int 
     */
    private $type = null;
    
    /**
     *
     * @var array | string 
     */
    private $response = null;

    public function __construct() {

    }
    
    /**
     * 
     * @param string $body
     */
    public function setHtmlResponse($body) {
        $this->type = self::HTMLTYPE;
        $this->response = $body;
        
    }
    
    /**
     * 
     * @param array $data
     */
    public function setJsonResponse($data) {
        $this->type = self::JSONTYPE;
        $this->response = $data;
    }
    
    /**
     * 
     * @param string $url
     * @return bool
     */
    public function redirect($url) {
        header("Location: {$url}");
        return;
        
    }
    
    /**
     * 
     * @return string
     * @throws \Exception
     */
    public function getResponse() {
        
        if ($this->type == null) {
            throw new \Exception('not response');
        }
        
        if ($this->type == self::HTMLTYPE) {
            echo $this->response;
            return;
        }
        
        if ($this->type == self::JSONTYPE) {
            echo json_encode($this->response);
            return;
        }
        
        throw new \Exception('not response');
        
    }
    
    
    
    
}

