<?php

namespace LAFramework\Container;

/**
 * class conteiner for all object
 * dependency injection conteiner
 */
class Container {

    /**
     *
     * @var array 
     */
    private $object;
    
    /**
     *
     * @var array
     */
    private $createObject = [];
    
    /**
     *
     * @var object self 
     */
    private static $self;

    public static function init() {
        if (!self::$self) {
            self::$self = new self();
        }

        return self::$self;
    }

    private function __construct() {
        $config = Config::getConfig();

        if (isset($config['components']) and count($config['components'])) {
            foreach ($config['components'] as $key => $component) {
                $this->set($key, $component);
            }
        }
    }

    /**
     * add dynamic object to container
     * @param string $alias
     * @param string $data
     */
    public function set($alias, $data) {
        $this->object[$alias] = $data;
    }
    

    /**
     * 
     * @param string $key
     * @param bool $new
     * @return object
     * @throws \Exception
     */
    public function get($key, $new = false) {

        if (array_key_exists($key, $this->createObject) && $new === false) {
            return $this->createObject[$key];
        } 
        if (isset($this->object[$key])) {

            if (!isset($this->object[$key])) {
                throw new \Exception("alias {$alias} not exists");
            }
            $alias = $this->object[$key];

            if (!isset($alias['class'])) {
                throw new \Exception("param class in alias {$alias} not exists");
            }

            $class = $alias['class'];

            if (!class_exists($class)) {
                throw new \Exception("class {$class} not exists");
            }

            $objectParam = [];
            if (isset($alias['params']) and count($alias['params'])) {

                foreach ($alias['params'] as $keyParam => $param) {
                    if (isset($param['type']) and $param['type'] == 'object') {
                        $objectParam[$keyParam] = $this->get($param['value']);
                    } else {
                        $objectParam[$keyParam] = $param['value'];
                    }
                }
            }

            $reflactionClass = new \ReflectionClass($class);

            if ($reflactionClass->hasMethod('__construct')) {
                $constructParams = $reflactionClass->getMethod('__construct')->getParameters();

                if (count($constructParams) != count($objectParam)) {
                    throw new \Exception("count of params is not matches in object {$key}");
                }

                foreach ($constructParams as $cParam) {

                    if (!array_key_exists($cParam->name,$objectParam)) {
                        throw new \Exception("could not fount param {$cParam->name} in object {$key}");
                    }

                    if ($cParam->getClass()) {
                        $instanceof = $cParam->getClass()->getName();
                        if (!$objectParam[$cParam->name] instanceof $instanceof) {
                            throw new \Exception("param {$cParam->name} is not instanceof {$instanceof}");

                        }

                    }

                }
            }


            $object = (isset($objectParam)) ? $reflactionClass->newInstanceArgs($objectParam) : $reflactionClass->newInstance();

            $this->createObject[$key] = $object;
            return $object;

        }
    }

}
