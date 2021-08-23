<?php

namespace App\Services\NFe;

use App\Exceptions\Billing\InvoiceException;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Complements;
use stdClass;

class Validator extends Api
{
    /**
     * The Standardize instance.
     *
     * @var Standardize
     */
    protected $standardize;

    /**
     * The Complements instance.
     *
     * @var Complements.
     */
    protected $complements;

    /**
     * Create the Invoice sender.
     *
     * @param Standardize $standardize
     * @param Complements $complements
     */
    public function __construct(Standardize $standardize, Complements $complements) 
    {
        $this->standardize = $standardize;
        $this->complements = $complements;

        parent::__construct();
    }

    /**
     * Validate a Invoice status by its receipt.
     *
     * @param string $receipt
     * @return array
     */
    public function validate(string $receipt): array
    {
        return $this->doRequest($receipt);
    }

    /**
     * Do the consult request.
     *
     * @param string $receipt
     * @return array
     */
    private function doRequest(string $receipt): array
    {
        $response = $this->tools->sefazConsultaRecibo($receipt);
        return $this->makeResponse($response);
    }

    /**
     * Make the response.
     *
     * @param string $response
     * @return array
     */
    private function makeResponse(string $response): array
    {
        $stdResponse = $this->standardize->toStd($response);

        return [
            'original' => $response,
            'response' => $stdResponse,
            'data'     => $this->getData($stdResponse, $response)
        ];
    }

    /**
     * Verify the batch status and return the NF-e data.
     *
     * @param stdClass $response
     * @param string $originalResponse
     * @return array
     */
    private function getData(stdClass $response, string $originalResponse): array
    {
        $stdResponse = $this->standardize->toStd($response);

        // Batch sent but not processed.
        if ($stdResponse->cStat == Api::SENT) {
            throw new InvoiceException(__('billing.invoice.fail.not_processed'), 422);
        }

        // Batch in processing. Wait.
        if ($stdResponse->cStat == Api::PROCESSING) {
            throw new InvoiceException(__('billing.invoice.fail.in_processing'), 422);
        }

        return $this->getProcessedData($response, $originalResponse);
    }

    /**
     * Return the processed invoice data.
     *
     * @param stdClass $response
     * @param string $originalResponse
     * @return array
     */
    private function getProcessedData(stdClass $response, string $originalResponse): array
    {
        // Error in processing.
        if ($response->cStat != Api::PROCESSED) {
            return [
                "status"    => false,
                "code"      => $response->cStat,
                "situation" => 'Rejeitada',
                "reason"    => $response->xMotivo,
            ];
        }

        // Authorized
        if ($response->protNFe->infProt->cStat == Api::AUTHORIZED) {
            return [
                "code"            => $response->protNFe->infProt->cStat,
                "status"          => false,
                "situation"       => "Autorizada",
                "protocol_number" => $response->protNFe->infProt->nProt,
                "protocol_xml"    => $originalResponse
            ];
        } 
        
        // Denied
        if (in_array($response->protNFe->infProt->cStat, Api::DENIED)) {
            return [
                "code"            => $response->protNFe->infProt->cStat,
                "status"          => false,
                "situation"       => 'Denegada',
                "reason"          => $response->protNFe->infProt->xMotivo,
                "protocol_number" => $response->protNFe->infProt->nProt,
                "protocol_xml"    => $originalResponse
            ];
        }

        // Not Authorized
        return [
            "code"      => $response->protNFe->infProt->cStat,
            "status"    => false,
            "situation" => 'Rejeitada',
            "reason"    => $response->protNFe->infProt->xMotivo,
        ];
    }
}