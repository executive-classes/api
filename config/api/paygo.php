<?php

use App\Enums\Apis\PayGoStatusEnum;

return [

    /**
     * Credentials
     */
    'uri' => isProduction() ? 'https://api.gate2all.com.br/v1/' : 'https://apidemo.gate2all.com.br/v1/',
    'authenticationApi' => 'ronaldo.executive',
    'authenticationKey' => '03DA4A26B8398A825B91',

    /**
     * Default info
     */
    
    'credit_card' => [
        'type' => 1,
        "capture" => false,
        "installments" => 1,
        "interestType" => 3,
        "authenticate" => 3,
    ],
    'bank_slip' => [
        "instructions" => "Aceitar somente até a data de vencimento, após essa data juros de 1% dia",
        "guarantor" =>  "Comprador",
        "provider" => "Itau"
    ],

    /**
     * Infos
     */

    'cancelableStatus' => [
        PayGoStatusEnum::STARTED,
        PayGoStatusEnum::AWAITING_PAYMENT,
        PayGoStatusEnum::ANALYZING,
        PayGoStatusEnum::AUTHORIZED,
        PayGoStatusEnum::CONFIRMED,
        PayGoStatusEnum::CONFIRMATION_PENDING
    ],
    
];