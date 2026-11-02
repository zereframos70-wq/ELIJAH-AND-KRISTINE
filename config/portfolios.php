<?php

return [
    'accounts' => [
        'ramos' => [
            'name' => 'Elijah T. Ramos',
            'email' => 'elijahramos@gmail.com',
            'password' => env('RAMOS_PORTFOLIO_PASSWORD'),
            'view' => 'ramos.index',
        ],
        'fabia' => [
            'name' => 'Kristine Irish A. Fabia',
            'email' => 'kristinefabia@gmail.com',
            'password' => env('FABIA_PORTFOLIO_PASSWORD'),
            'view' => 'fabia.index',
        ],
    ],
];
