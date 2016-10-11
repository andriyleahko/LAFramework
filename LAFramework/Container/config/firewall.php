<?php

return [
    'firewall' => [
        'class' => '\LAFramework\Auth\Firewall',
        'params' => [
            'paths' => [
                'value' => [
                    'login' => '/login_check',
                    'login_form' => '/login',
                ]
            ],
            'auth' => [
                'type' => 'object',
                'value' => 'auth'
            ]
        ],
    ],
    
];