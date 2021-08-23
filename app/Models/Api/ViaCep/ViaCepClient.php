<?php

namespace App\Support\Api\ViaCep;

use App\Support\Api\GuzzleClient;
use App\Support\Api\GuzzleResponse;

/**
 * Client used for request to ViaCep API.
 * 
 * @see https://viacep.com.br/
 */
class ViaCepClient extends GuzzleClient
{
    /**
     * Return type.
     * 
     * @var string
     */
    protected $_return;

    /**
     * Set the credentials of the client.
     *
     * @return void
     */
    protected function _setCredentials(): void
    {
        $this->_setUri(config('api.viacep.uri'));
        $this->_return = config('api.viacep.return');
    }

    /**
     * Consult a address by a CEP (zip code).
     *
     * @param string $cep
     * @return GuzzleResponse
     */
    public function consult(string $cep): GuzzleResponse
    {
        return $this->get("{$cep}/{$this->_return}")
            ->send();
    }

    /**
     * Consult a CEP (zip code) by a address.
     *
     * @param string $uf
     * @param string $city
     * @param string $address
     * @return GuzzleResponse
     */
    public function search(string $uf, string $city, string $address): GuzzleResponse
    {
        return $this->get("{$uf}/{$city}/{$address}/{$this->_return}")
            ->send();
    }
}