<?php

return [
    'firewallProcessor' => [
        'class' => '\LAFramework\Auth\Listeners\FirewallListener',
        'params' => [
            'firewall' => [
                'type' => 'object',
                'value' => 'firewall'
            ],
            
        ],
    ],
    
    'auth' => [
        'class' => '\LAFramework\Auth\Auth',
        'params' => [
            'session' => [
                'type' => 'object',
                'value' => 'session'
            ],
            'request' => [
                'type' => 'object',
                'value' => 'request'
            ],
            'authHandler' => [
                'type' => 'object',
                'value' => '%authHandler%'
            ],
            'passCrypt' => [
                'type' => 'object',
                'value' => '%passCrypt%'
            ],
            'baseAuthProvider' => [
                'type' => 'object',
                'value' => 'baseAuthProvider'
            ],
            'validation' => [
                'type' => 'object',
                'value' => 'validation'
            ]
            
            
        ],
    ],
    
    'baseAuthProvider' => [
        'class' => '\LAFramework\Auth\UserProvider\BaseProvider',
        'params' => [
            'adapter' => [
                'type' => 'object',
                'value' => '%authUserAdapter%'
            ],
            
        ],
    ],
    
    'userDbAdapter' => [
        'class' => '\LAFramework\Auth\UserProvider\Adapter\Base',
        'params' => [
            'table' => [
                'value' => '%userTable%'
            ],
            'doctrine' => [
                'type' => 'object',
                'value' => 'doctrine'
            ],
            
        ],
    ],
    'userDataAdapter' => [
        'class' => '\LAFramework\Auth\UserProvider\Adapter\Data',
        'params' => [
            'data' => [
                'value' => '%userData%'
            ],
            
        ],
    ]
];