<?php

return [
    'firewall' => [
        'class' => '\LAFramework\Auth\Firewall',
        'params' => [
            'paths' => [
                'value' => [
                    'login' => '/login',
                ]
            ],
            'auth' => [
                'type' => 'object',
                'value' => 'auth'
            ]
        ],
    ],
    
];