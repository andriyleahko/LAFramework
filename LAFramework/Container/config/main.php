<?php

return [
    'request' => [
        'class' => '\LAFramework\HttpFoundation\Request'
    ],
    'request' => [
        'class' => '\LAFramework\HttpFoundation\Request',
    ],
    'response' => [
        'class' => '\LAFramework\HttpFoundation\Response',
    ],
    'processor' => [
        'class' => '\LAFramework\Processor\Processor',
        'params' => [
            'route' => [
                'type' => 'object',
                'value' => 'route'
            ],
            'request' => [
                'type' => 'object',
                'value' => 'request'
            ]
        ]
    ],
    'route' => [
        'class' => '\LAFramework\Router\Route',
        'params' => [
            'request' => [
                'type' => 'object',
                'value' => 'request'
            ],
            'routePath' => [
                'value' => 'config/routing/route.php'
            ]
        ]
    ],
    'view' => [
        'class' => '\LAFramework\View\View',
        'params' => [
            'templatePath' => [
                'value' => '%templatePath%'
            ],
            'baseTmpl' => [
                'value' => '%baseTmpl%'
            ]
        ]
    ],
];

