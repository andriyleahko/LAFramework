<?php

return [
    'validation' => [
        'class' => '\LAFramework\Validation\Validation',
        'params' => [
            'validationClasses' => [
                'value' => [
                    'email' => '\LAFramework\Validation\Classes\Email',
                    'notEmpty' => '\LAFramework\Validation\Classes\NotEmpty',
                    'length' => '\LAFramework\Validation\Classes\Length'    
                ]
            ],
            'customValidationClasses' => [
                'value' => '%customValidationClasses%'
            ],
            'clearClasses' => [
                'value' => [
                    'basic' => '\LAFramework\Validation\Clears\Basic'
                ]
            ],
            'clearCustomClasses' => [
                'value' => '%customClearClasses%'
            ]
            
        ],
    ],
    
    
];