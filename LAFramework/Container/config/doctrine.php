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
            'typeEndityMap' => [
                'value' => '%typeEntityMap%'
            ],
            'entityPath' => [
                'value' => '%entityDir%'
            ],
            'dbenable' => [
                'value' => '%dbenable%'
            ],

        ],

    ],
];