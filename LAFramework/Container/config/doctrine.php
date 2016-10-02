<?php

return [
    'doctrine' => [
        'class' => '\LAFramework\Doctrine\Doctrine',
        'params' => [
            'dataBaseParams' => [
                'value' => [
                    'host' => 'localhost',
                    'driver'   => 'pdo_mysql',
                    'user'     => 'root',
                    'password' => 'root',
                    'dbname'   => 'doctrine_test',
                ]
            ],
            'entityPath' => [
                'value' => 'Entity'
            ],

        ],

    ],
];