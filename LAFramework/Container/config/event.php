<?php
return [
    'dispatcher' => [
        'class' => '\LAFramework\Dispatcher\Dispatcher',
        'params' => [
            'events' => [
                /**
                 * @example
                 *
                'value' => [
                    'onKeyEvent' => [
                        'component' => 'componentName',
                        'method' => 'methodName'
                    ]
                ]
                 * 
                 */
            ]
        ]
    ],
];