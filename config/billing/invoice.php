<?php

use Carbon\Carbon;

return [
    'version' => '4.0',
    'certificate' => [
        'file_path' => config('billing.invoice.certificate.dir') . config('billing.invoice.certificate.name'),
        'dir' => storage_path('app/invoice/'),
        'name' => 'certificado.pfx',
        'password' => 'Senha'
    ],
    'config' => [
        "atualizacao" => Carbon::now()->toDateTimeString(),
        "tpAmb" => isProduction() ? 1 : 2,
        "razaosocial" => config('executive_classes.name'),
        "siglaUF" => config('executive_classes.address.uf'),
        "cnpj" => config('executive_classes.cnpj'),
        "schemes" => "PL_008i2",
        "versao" => config('billing.invoice.version'),
        "tokenIBPT" => "AAAAAAA"
    ]
];