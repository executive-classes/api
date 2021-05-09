<?php

namespace Tests\Integration\ViaCep;

use App\Apis\ViaCep\ViaCepClient;
use Tests\TestCase;

class CepTest extends TestCase
{
    /**
     * ViaCep client.
     * 
     * @var ViaCepClient
     */
    private $client;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->client = new ViaCepClient;
    }

    public function test_consult_address_by_cep()
    {
        $cep = config('test.viacep.cep');
        $response = $this->client->consult($cep);

        $this->assertIsObject($response);
        $this->assertEquals(format_zip($cep), $response->cep);
        $this->assertEquals(config('test.viacep.logradouro'), $response->logradouro);
        $this->assertEquals(config('test.viacep.bairro'), $response->bairro);
        $this->assertEquals(config('test.viacep.localidade'), $response->localidade);
        $this->assertEquals(config('test.viacep.uf'), $response->uf);
    }

    public function test_consult_cep_by_address()
    {
        $logradouro = config('test.viacep.logradouro');
        $localidade = config('test.viacep.localidade');
        $uf = config('test.viacep.uf');
        
        $response = $this->client->search($uf, $localidade, $logradouro);
        $this->assertIsObject($response);
        $this->assertCount(5, $response->content());

        
        $address = $response->content()[0];
        $this->assertEquals(format_zip(config('test.viacep.cep')), $address->cep);
        $this->assertEquals($logradouro, $address->logradouro);
        $this->assertEquals(config('test.viacep.bairro'), $address->bairro);
        $this->assertEquals($localidade, $address->localidade);
        $this->assertEquals($uf, $address->uf);
    }

    
}
