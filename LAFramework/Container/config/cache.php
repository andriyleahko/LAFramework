<?php

return [
    'memCache' => [
        'class' => '\LAFramework\Cache\Adapter\MemCache',
        'params' => [
            'host' => [
                'value' => '%memcacheHost%'
            ],
            'port' => [
                'value' => '%memcachePort%'
            ]
        ],
    ],
    'fileCache' => [
        'class' => '\LAFramework\Cache\Adapter\FileCache',
        'params' => [
            'path' => [
                'value' => '%filecachePath%'
            ],
        ],
    ],
    'redisCache' => [
        'class' => '\LAFramework\Cache\Adapter\RedisCache',
        'params' => [
            'host' => [
                'value' => '%redisHost%'
            ],
            'port' => [
                'value' => '%redisPort%'
            ],
            'pass' => [
                'value' => '%redisPass%'
            ],
        ],
    ],
    'cache' => [
        'class' => '\LAFramework\Cache\BaseCache',
        'params' => [
            'adapter' => [
                'type' => 'object',
                'value' => '%cachedriver%'
            ]
        ]
    ],
];
