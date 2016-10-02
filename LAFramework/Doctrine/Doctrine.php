<?php

namespace LAFramework\Doctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * class for init doctrine in project
 */
class Doctrine {
    
    /**
     *
     * @var array 
     */
    private $dataBaseParams;
    
    /**
     *
     * @var string 
     */
    private $entityPath;
    
    /**
     *
     * @var bool 
     */
    private $dbenable;
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    /**
     * 
     * @param array $dataBaseParams
     * @param string $entityPath
     */
    public function __construct($dataBaseParams, $entityPath, $dbenable) {
        
        $this->dbenable = $dbenable;
        
        if ($this->dbenable) {
        
            $this->dataBaseParams = $dataBaseParams;

            $this->entityManager = $entityPath;

            $isDevMode = true;

            $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/{$this->entityPath}"), $isDevMode);

            $this->entityManager = EntityManager::create($this->dataBaseParams, $config);
        
        }
        
        
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        
        return $this->entityManager;
        
    }
    
    
    
}