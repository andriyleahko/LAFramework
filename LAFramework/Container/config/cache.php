<?php

return [
    'memCache' => [
        'class' => '\LAFramework\Cache\Adapter\MemCache',
        'params' => [
            'host' => [
                'value' => '127.0.0.1'
            ],
            'port' => [
                'value' => '11211'
            ]
        ],
    ],
    'fileCache' => [
        'class' => '\LAFramework\Cache\Adapter\FileCache',
        'params' => [
            'path' => [
                'value' => 'tmp'
            ],
        ],
    ],
    'redisCache' => [
        'class' => '\LAFramework\Cache\Adapter\RedisCache',
        'params' => [
            'host' => [
                'value' => '127.0.0.1'
            ],
            'port' => [
                'value' => '6379'
            ],
            'pass' => [
                'value' => 'foobared'
            ],
        ],
    ],
    'cache' => [
        'class' => '\LAFramework\Cache\BaseCache',
        'params' => [
            'adapter' => [
                'type' => 'object',
                'value' => 'memCache'
            ]
        ]
    ],
];

