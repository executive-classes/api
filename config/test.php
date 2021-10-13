<?php

use App\Enums\Billing\StateEnum;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Billing Test Settings
    |--------------------------------------------------------------------------
    |
    | This define the default settings for the billing entities in the test
    | environment.
    |
    */

    'billing' => [
        'phone' => '63987460698',
        'phone_alt' => '6337136585'
    ],

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
    | Default Tax Test Settings
    |--------------------------------------------------------------------------
    |
    | This define the default info for the Tax in the test environment.
    |
    */

    'tax' => [
        'cnpj' => [
            'valid' => [
                '16254776000178', 
                '16.254.776/0001-78'
            ],
            'invalid' => [
                '11222333444455', 
                '11.222.333/4444-55'
            ],
        ],
        'cpf' => [
            'valid' => [
                '22404056000', 
                '224.040.560-00'
            ],
            'invalid' => [
                '11122233344', 
                '111.222.333-44'
            ]
        ],
        'rg' => [
            'valid' => [
                '214888769',
                '26311529x',
                '21.488.876-9',
                '26.311.529-x'
            ],
            'invalid' => [
                '112223334',
                '11222333x',
                '11.222.333-4',
                '11.222.333-x'
            ],
        ],
        'ie' => [
            'valid' => [
                StateEnum::AC => ['0113834280122', '01.138.342/801-22'],
                StateEnum::AL => ['248616536', '248616536'],
                StateEnum::AP => ['036677868', '036677868'],
                StateEnum::AM => ['123332761', '12.333.276-1'],
                StateEnum::BA => ['96919640', '969196-40'],
                StateEnum::CE => ['781604842', '78160484-2'],
                StateEnum::DF => ['0759389500121', '07593895001-21'],
                StateEnum::ES => ['123729980', '12372998-0'],
                StateEnum::GO => ['153763809', '15.376.380-9'],
                StateEnum::MA => ['120373459', '12037345-9'],
                StateEnum::MT => ['91222256870', '9122225687-0'],
                StateEnum::MS => ['288346734', '28834673-4'],
                StateEnum::MG => ['8276202336778', '827.620.233/6778'],
                StateEnum::PA => ['153660732', '15-366073-2'],
                StateEnum::PB => ['950532347', '95053234-7'],
                StateEnum::PR => ['1877560496', '187.75604-96'],
                StateEnum::PE => ['254318622', '2543186-22'],
                StateEnum::PI => ['608773220', '60877322-0'],
                StateEnum::RJ => ['59405926', '59.405.92-6'],
                StateEnum::RN => ['208348859', '20.834.885-9'],
                StateEnum::RS => ['9918722504', '991/8722504'],
                StateEnum::RO => ['61005783988412', '6100578398841-2'],
                StateEnum::RR => ['247543017', '24754301-7'],
                StateEnum::SP => ['729213667441', '729.213.667.441'],
                StateEnum::SC => ['701860472', '701.860.472'],
                StateEnum::SE => ['067227155', '06722715-5'],
                StateEnum::TO => ['09032076220', '0903207622-0'],
            ],
            'invalid' => [
                StateEnum::AC => ['1122233344455', '11.222.333/444-55'],
                StateEnum::AL => ['111111111', '111111111'],
                StateEnum::AP => ['111111111', '111111111'],
                StateEnum::AM => ['112223334', '11.222.333-4'],
                StateEnum::BA => ['11111122', '111111-22'],
                StateEnum::CE => ['111111112', '11111111-2'],
                StateEnum::DF => ['1111111111122', '11111111111-22'],
                StateEnum::ES => ['111111112', '11111111-2'],
                StateEnum::GO => ['112223334', '11.222.333-4'],
                StateEnum::MA => ['111111118', '11111111-2'],
                StateEnum::MT => ['11111111112', '1111111111-2'],
                StateEnum::MS => ['1111111112', '111111111-2'],
                StateEnum::MG => ['1112223334444', '111.222.333/4444'],
                StateEnum::PA => ['112222223', '11-222222-3'],
                StateEnum::PB => ['111111112', '11111111-2'],
                StateEnum::PR => ['1112222233', '111.22222-33'],
                StateEnum::PE => ['111111122', '1111111-22'],
                StateEnum::PI => ['111111112', '11111111-2'],
                StateEnum::RJ => ['11222334', '11.222.33-4'],
                StateEnum::RN => ['112223334', '11.222.333-4'],
                StateEnum::RS => ['1112222222', '111/2222222'],
                StateEnum::RO => ['11111111111113', '1111111111111-3'],
                StateEnum::RR => ['111111112', '11111111-2'],
                StateEnum::SP => ['111222333444', '111.222.333.444'],
                StateEnum::SC => ['111222333', '111.222.333'],
                StateEnum::SE => ['111111112', '11111111-2'],
                StateEnum::TO => ['11111111112', '1111111111-2'],
            ]
        ]
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
