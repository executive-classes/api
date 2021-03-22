<?php

namespace App\Services\Invoice;

use NFePHP\Common\Certificate;
use NFePHP\NFe\Tools;

class Api
{
    /**
     * The NF-e Authorized status.
     */
    protected const AUTHORIZED = 100;

    /**
     * The NF-e sent status.
     */
    protected const SENT = 103;

    /**
     * The NF-e processed status.
     */
    protected const PROCESSED = 104;

    /**
     * The NF-e in processing status.
     */
    protected const PROCESSING = 105;

    /**
     * The NF-e denied status.
     */
    protected const DENIED = ["110", "301", "302"];

    /**
     * Tools
     *
     * @var Tools
     */
    protected $tools;

    /**
     * Create the API.
     */
    public function __construct() 
    {
        $this->tools = $this->__createTools();
    }

    /**
     * Create the Tools instance.
     *
     * @return Tools
     */
    private function __createTools(): Tools
    {
        $config = json_encode(config('billing.invoice.config'));

        $certificate = file_get_contents(config('billing.invoice.certificate.file_path'));
        $password = config('billing.invoice.certificate.password');

        return new Tools($config, Certificate::readPfx($certificate, $password));
    }
}