<?php

return [
    'firewall' => [
        'class' => '\LAFramework\Auth\Firewall',
        'params' => [
            'paths' => [
                'value' => [
                    'login' => '/login_check',
                ]
            ],
            'auth' => [
                'type' => 'object',
                'value' => 'auth'
            ]
        ],
    ],
    
];