<?php

namespace App\Apis\PayGo;

use App\Apis\GuzzleClient;
use App\Apis\GuzzleResponse;
use App\Exceptions\PayGo\PayGoException;
use Exception;

/**
 * Client used for make request in the Gate2All Api.
 * 
 * @see https://docs.gate2all.com.br
 */
class Gate2AllClient extends GuzzleClient
{
    /**
     * Set the credentials of the client.
     *
     * @return void
     */
    protected function _setCredentials(): void
    {
        $this->_setUri(config('api.paygo.uri'));
    }

    /**
     * Do the authentication of the client.
     *
     * @return void
     */
    protected function _auth(): void
    {
        $this->_headers([
            'authenticationApi' => config('api.paygo.authenticationApi'),
            'authenticationKey' => config('api.paygo.authenticationKey')
        ]);
    }

    /**
     * Catch a request error.
     *
     * @param GuzzleResponse $response
     * @return Exception
     */
    protected function _throw(GuzzleResponse $response): Exception
    {
        $message = $response->error->message;
        return new PayGoException($message, $response->code());
    }

    /**
     * Consult a transaction by its id.
     *
     * @param string $transactionId
     * @return GuzzleResponse
     */
    public function consult(string $transactionId): GuzzleResponse
    {
        return $this->get("transactions/$transactionId")
            ->send();
    }

    /**
     * Consult a transaction by its reference id.
     *
     * @param string $referenceId
     * @param integer $limit
     * @return GuzzleResponse
     */
    public function consultByReference(string $referenceId, int $limit = null): GuzzleResponse
    {
        return $this->get("transactions")
            ->params(['referenceId' => $referenceId])
            ->paramsIf($limit !== null, ['limit' => $limit])
            ->send();
    }

    /**
     * Create a transaction.
     *
     * @param array $data
     * @return GuzzleResponse
     */
    public function transaction(array $data): GuzzleResponse
    {
        return $this->post('transactions')
            ->json($data)
            ->send();
    }

    /**
     * Make the payment of a credit card transaction.
     *
     * @param string $transactionId
     * @param integer $amount
     * @return GuzzleResponse
     */
    public function capture(string $transactionId, int $amount = null): GuzzleResponse
    {
        return $this->put("transactions/$transactionId/capture")
            ->paramsIf($amount !== null, ['amount' => $amount])
            ->send();
    }

    /**
     * Cancel a transaction.
     *
     * @param string $transactionId
     * @param integer $amount
     * @return GuzzleResponse
     */
    public function cancel(string $transactionId, int $amount = null): GuzzleResponse
    {
        return $this->put("transactions/$transactionId/void")
            ->paramsIf($amount !== null, ['amount' => $amount])
            ->send();
    }

    /**
     * Create a token for a credit card.
     *
     * @param array $data
     * @return GuzzleResponse
     */
    public function tokenization(array $data): GuzzleResponse
    {
        return $this->post('tokenization')
            ->json($data)
            ->send();
    }

    /**
     * Consult a credit card token by its token.
     *
     * @param string $token
     * @return GuzzleResponse
     */
    public function consultToken(string $token): GuzzleResponse
    {
        return $this->get("tokenization/$token")
            ->send();
    }

    /**
     * Consult a credit card token by its reference id.
     *
     * @param string $referenceId
     * @param integer $limit
     * @return GuzzleResponse
     */
    public function consultTokenByReference(string $referenceId, int $limit = null): GuzzleResponse
    {
        return $this->get("tokenization")
            ->params(['referenceId' => $referenceId])
            ->paramsIf($limit !== null, ['limit' => $limit])
            ->send();
    }
}