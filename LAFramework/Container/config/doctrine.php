<?php

return [
    'doctrine' => [
        'class' => '\LAFramework\Doctrine\Doctrine',
        'params' => [
            'dataBaseParams' => [
                'value' => [
                    'host' => '%dbhost%',
                    'driver'   => '%dbdriver%',
                    'user'     => '%dbuser%',
                    'password' => '%dbpass%',
                    'dbname'   => '%dbname%',
                ]
            ],
            'entityPath' => [
                'value' => 'Entity'
            ],
            'dbenable' => [
                'value' => '%dbenable%'
            ],

        ],

    ],
];