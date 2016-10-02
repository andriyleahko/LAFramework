<?php

namespace LAFramework\Container;

/**
 * main config for all project
 */
class Config 
{
    /**
     *
     * @var string
     */
    private static $configPath = 'config';
    /**
     * @var array
     */
    private static $config = null;
    
    
    /**
     * @return array Description
     */
    public static function getConfig() {
        
        if (self::$config == null) {
            $configsFile = scandir(self::$configPath);

            $configRes = ['components'=>[]];
            foreach ($configsFile as $config) {
                if ($config != '.' and $config != '..' and strstr($config,'.php')) {
                    $configCurrent = include_once self::$configPath . '/' . $config;
                    $configRes['components'] = array_merge($configRes['components'], $configCurrent);
                }

            }
        }
      
        self::$config = $configRes;
        
        return self::$config;
    }
}