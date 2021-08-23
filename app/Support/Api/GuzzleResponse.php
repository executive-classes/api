<?php

namespace App\Support\Api;

use App\Exceptions\ApiException;

class GuzzleResponse
{
    /**
     * Status of response.
     * 
     * @var int
     */
    private $code;

    /**
     * Content of the response.
     * 
     * @var null|object
     */
    private $content;

    /**
     * Create the Guzzle Response class.
     *
     * @param integer $code
     * @param null|object|array $content
     * @param string $message
     */
    public function __construct(int $code, $content = null)
    {
        if (!isHttpCode($code)) {
            throw new ApiException(__('system.apis.error.invalid_http_code', $code), 500);
        }

        $this->code = $code;
        $this->content = $content;
    }

    /**
     * Return a item of the content.
     *
     * @param string $property
     * @return void
     */
    public function __get($property)
    {
        if (!isset($this->content->$property)) {
            return null;
        }

        if (is_array($this->content)) {
            return $this->content[$property];
        }

        return $this->content->$property;
    }
    
    /**
     * Returns the response Http code.
     *
     * @return int
     */
    public function code(): int
    {
        return $this->code;
    }

    /**
     * Returns the response content.
     *
     * @return mixed
     */
    public function content()
    {
        return $this->content;
    }
}