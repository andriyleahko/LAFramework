<?php

return [
    'firewall' => [
        'class' => '\LAFramework\Auth\Firewall',
        'params' => [
            'rules' => [
                'value' => '%firewallRule%'
            ],
            'roles' => [
                'value' => [
                    'Anonim',
                    'User',
                    'Admin',
                    'SuperAdmin'            
                ]
            ],
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