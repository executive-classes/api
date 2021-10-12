<?php

namespace Tests\Providers\Api;

trait ViaCepProvider
{
    private function makeOneConsultData(): object
    {
        return (object) [
            'cep' => config('test.viacep.cep'),
            'logradouro' => config('test.viacep.logradouro'),
            'bairro' => config('test.viacep.bairro'),
            'localidade' => config('test.viacep.localidade'),
            'uf' => config('test.viacep.uf'),
        ];
    }
}