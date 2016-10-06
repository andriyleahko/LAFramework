<?php
return [
    'dispatcher' => [
        'class' => '\LAFramework\Dispatcher\Dispatcher',
        'params' => [
            'events' => [
                'value' => '%events%'
            ],
            'baseEvents' => [
                'value' => include __DIR__ . '/events/events.php' 

            ]
        ]
    ],
];