<?php

namespace App\Services\Invoice;

use App\Models\Billing\Invoice\Invoice;
use App\Models\Billing\Invoice\InvoiceRepository;
use App\Services\Invoice\Api\Maker;

class ExportInvoice
{
    /**
     * The Invoice Repository
     *
     * @var InvoiceRepository
     */
    private $invoiceRepository;

    /**
     * The NF-e XML maker.
     *
     * @var Maker
     */
    private $maker;

    /**
     * The NF-e XML sender.
     *
     * @var Sender
     */
    private $sender;

    /**
     * The NF-e validator.
     *
     * @var Validator
     */
    private $validator;

    /**
     * Create the Export Invoice.
     *
     * @param InvoiceRepository $invoiceRepository
     * @param Maker $maker
     * @param Sender $sender
     * @param Validator $validator
     */
    public function __construct(InvoiceRepository $invoiceRepository, Maker $maker, Sender $sender, Validator $validator) 
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->maker = $maker;
        $this->sender = $sender;
        $this->validator = $validator;
    }

    /**
     * Create the Invoice XML.
     *
     * @param Invoice $invoice
     * @return Invoice
     */
    public function generate(Invoice $invoice): Invoice
    {
        $xml = $this->maker->make($invoice);
        $signedXml = $this->maker->sign($xml);
        return $this->invoiceRepository->generateInvoice($invoice, $signedXml);
    }

    /**
     * Send the Invoice XML.
     *
     * @param Invoice $invoice
     * @return Invoice
     */
    public function send(Invoice $invoice): Invoice
    {
        $receipt = $this->sender->send($invoice->xml);
        return $this->invoiceRepository->sendInvoice($invoice, $receipt);
    }

    /**
     * Get the result of the processed Invoice.
     *
     * @param Invoice $invoice
     * @return Invoice
     */
    public function protocol(Invoice $invoice): Invoice
    {
        $validation = $this->validator->validate($invoice->receipt);

        if (!$validation['data']['status']) {
            return $this->invoiceRepository->errorInvoice($invoice, $validation['data']['reason']);
        }

        $protocol_xml = $this->maker->protocol($invoice->xml, $validation['data']['protocol_xml']);
        return $this->invoiceRepository->protocolInvoice($invoice, $protocol_xml);
    }
    
}