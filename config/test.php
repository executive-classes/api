<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default User Test Settings
    |--------------------------------------------------------------------------
    |
    | This define the default settings for the Users in the test environment.
    |
    */

    'user' => [
        'email' => 'ronaldo.stiene@executiveclasses.com.br',
        'password' => 'Teste123@'
    ],

    /*
    |--------------------------------------------------------------------------
    | Default PayGo Test Settings
    |--------------------------------------------------------------------------
    |
    | This define the default settings for the PayGo in the test environment.
    |
    */

    'paygo' => [
        'brands' => [
            'valid' => ['Visa', 'MasterCard', 'Diners', 'Elo', 'Aura'],
            'invalid' => ['Hipercard']
        ],
        'token' => '32c76df1-038b-4562-98a9-b52d50455dc540251'
    ]

];