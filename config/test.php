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
        'type' => [
            'dev' => [
                'email' => 'ronaldo.stiene@executiveclasses.com.br',
                'name' => 'Ronaldo Stiene',
                'tax_type_id' => 'cpf',
                'tax_code' => '47020345883'
            ],
            'adm' => [
                'email' => 'adm@executiveclasses.com.br',
                'name' => 'Admin',
                'tax_type_id' => 'cpf',
                'tax_code' => '62258731046'
            ],
            'fin' => [
                'email' => 'financial@executiveclasses.com.br',
                'name' => 'Financeiro',
                'tax_type_id' => 'cpf',
                'tax_code' => '36863037017'
            ],
            'tech' => [
                'email' => 'tech@executiveclasses.com.br',
                'name' => 'Técnico',
                'tax_type_id' => 'cpf',
                'tax_code' => '89702480051'
            ],
            'teacher' => [
                'email' => 'maria.souza@executiveclasses.com.br',
                'name' => 'Maria Souza',
                'tax_type_id' => 'cpf',
                'tax_code' => '32707859095'
            ],
            'student' => [
                'email' => 'joao.silva@executiveclasses.com.br',
                'name' => 'João da Silva',
                'tax_type_id' => 'cpf',
                'tax_code' => '95845912075'
            ],
        ],
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
    ],

    /*
    |--------------------------------------------------------------------------
    | Default ViaCep Test Settings
    |--------------------------------------------------------------------------
    |
    | This define the default settings for the ViaCep in the test environment.
    |
    */

    'viacep' => [
        'cep' => '01001000',
        "logradouro" => "Praça da Sé",
        "bairro" => "Sé",
        "localidade" => "São Paulo",
        "uf" => "SP"
    ]

];
