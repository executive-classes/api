<?php

namespace App\Services\NFe;

use App\Exceptions\Billing\InvoiceException;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Complements;
use stdClass;

class Sender extends Api
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
     * Send the xml.
     *
     * @param string $xml
     * @return string
     */
    public function send(string $xml): string
    {
        $response = $this->sendRequest($xml);
        return $this->getReceipt($response);
    }

    /**
     * Do the request.
     *
     * @param string $xml
     * @return stdClass
     */
    private function sendRequest(string $xml): stdClass
    {
        $response = $this->tools->sefazEnviaLote([$xml], $this->getId());
        return $this->validateResponse($response);
    }

    /**
     * Validate the response.
     *
     * @param string $response
     * @return stdClass
     */
    private function validateResponse(string $response): stdClass
    {
        $response = $this->standardize->toStd($response);

        if ($response->cStat != Api::SENT) {
            $message = "[$response->cStat] $response->xMotivo";
            throw new InvoiceException(__('billing.invoice.fail.send_batch', compact('message')), 500);
        }

        return $response;
    }

    /**
     * Get the receipt of the response
     *
     * @param stdClass $response
     * @return string
     */
    private function getReceipt(stdClass $response): string
    {
        return $response->infRec->nRec;
    }

    /**
     * Get the ID.
     *
     * @return string
     */
    private function getId(): string
    {
        return str_pad(100, 15, '0', STR_PAD_LEFT);
    }

}