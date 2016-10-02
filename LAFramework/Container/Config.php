<?php

namespace LAFramework\Container;

/**
 * main config for all project
 */
class Config {

    /**
     *
     * @var string
     */
    private static $configPath = 'config';

    /**
     *
     * @var string
     */
    private static $paramsPath = 'config/params/param.php';

    /**
     *
     * @var array 
     */
    private static $params;

    /**
     * @var array
     */
    private static $config = null;

    /**
     * @return array Description
     */
    public static function getConfig() {


        if (self::$config == null) {

            $configPathBase = __DIR__ . '/config';
            $configRes = ['components' => []];

            self::parseConfig($configPathBase, $configRes);
            self::parseConfig(self::$configPath, $configRes);

            self::$params = include_once self::$paramsPath;

            $configRes = self::addParams($configRes);
        }

        self::$config = $configRes;


        return self::$config;
    }

    /**
     * 
     * @param string $dir
     * @param array $configRes
     */
    private static function parseConfig($dir, &$configRes) {

        $configsFile = scandir($dir);

        foreach ($configsFile as $config) {
            if ($config != '.' and $config != '..' and strstr($config, '.php')) {
                $configCurrent = include_once $dir . '/' . $config;
                $configRes['components'] = array_merge($configRes['components'], $configCurrent);
            }
        }
    }

    /**
     * 
     * @param array $config
     * @return array
     */
    private static function addParams($config) {

        $config = json_encode($config);


        $arrReplace = [];
        $arrReplacing = [];
        foreach (self::$params as $key => $value) {
            if (is_array($value)) {
                $arrReplace[] = '"%' . $key . '%"';
                $arrReplacing[] = json_encode($value);
            } else {
                $arrReplace[] = "%$key%";
                $arrReplacing[] = $value;
            }
        }

        $config = str_replace($arrReplace, $arrReplacing, $config);

        $config = json_decode($config,true);
      
        return $config;
    }

    /**
     * 
     * @param string $key
     * @return string
     */
    public static function getParam($key) {

        $key = "%{$key}%";
        return self::$params[$key];
    }

}
