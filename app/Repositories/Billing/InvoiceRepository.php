<?php

namespace App\Repositories\Billing;

use App\Models\Billing\Invoice;
use App\Models\Billing\InvoiceStatus;
use App\Repositories\Repository;

class InvoiceRepository extends Repository
{
    /**
     * Create the Invoice Repository
     *
     * @param Invoice $model
     */
    public function __construct(Invoice $model) 
    {
        $this->model = $model;
    }

    /**
     * Update the invoice to the generated status.
     *
     * @param Invoice|string $invoice
     * @param string $xml
     * @return Invoice
     */
    public function generateInvoice($invoice, string $xml): Invoice
    {
        $invoice = $this->getModel($invoice);

        $invoice->invoice_status_id = InvoiceStatus::GENERATED;
        $invoice->xml = $xml;
        $invoice->save();

        return $invoice;
    }

    /**
     * Update the invoice to the sent status.
     *
     * @param Invoice|string $invoice
     * @param string $receipt
     * @return Invoice
     */
    public function sendInvoice($invoice, string $receipt): Invoice
    {
        $invoice = $this->getModel($invoice);

        $invoice->invoice_status_id = InvoiceStatus::SENT;
        $invoice->receipt = $receipt;
        $invoice->save();

        return $invoice;
    }

    /**
     * Update the invoice to the ok status.
     *
     * @param Invoice:string $invoice
     * @param string $xml
     * @return Invoice
     */
    public function protocolInvoice($invoice, string $xml): Invoice
    {
        $invoice = $this->getModel($invoice);

        $invoice->invoice_status_id = InvoiceStatus::OK;
        $invoice->xml = $xml;
        $invoice->save();

        return $invoice;
    }

    /**
     * Update the invoice to the error status.
     *
     * @param Invoice|string $invoice
     * @param string $message
     * @return Invoice
     */
    public function errorInvoice($invoice, string $message): Invoice
    {
        $invoice = $this->getModel($invoice);

        $invoice->invoice_status_id = InvoiceStatus::ERROR;
        $invoice->error_message = $message;
        $invoice->save();

        return $invoice;
    }
}
