<?php

namespace App\Apis;

use Exception;

class GuzzleRequest
{
    /**
     * Method Get.
     */
    const GET = 'GET';

    /**
     * Method Post.
     */
    const POST = 'POST';

    /**
     * Method Put.
     */
    const PUT = 'PUT';

    /**
     * Method Patch.
     */
    const PATCH = 'patch';

    /**
     * Method Delete.
     */
    const DELETE = 'delete';

    /**
     * Send params like Query String.
     */
    const QUERY = 'query';

    /**
     * Send params like Form Params (x-www-form-urlencoded).
     */
    const FORM_PARAMS = 'form_params';

    /**
     * Send params like Json.
     */
    const JSON = 'json';

    /**
     * Send params on body.
     */
    const BODY = 'body';

    /**
     * Send params like multipart (files).
     */
    const MULTIPART = 'multipart';

    /**
     * Request uri.
     * 
     * @var string
     */
    private $uri;

    /**
     * Request method.
     * 
     * @var string
     */
    private $method;

    /**
     * Request params.
     * 
     * @var array
     */
    private $options = [];

    /**
     * The default param type association.
     * 
     * @var array
     */
    private $defaultParamsType = [
        self::GET => self::QUERY,
        self::POST => self::FORM_PARAMS,
        self::PUT => self::JSON,
        self::PATCH => self::JSON,
        self::DELETE => self::QUERY,
    ];

    /**
     * Create de Guzzle Request.
     *
     * @param string $uri
     * @param string $method
     * @param string $paramType
     */
    public function __construct(string $uri, string $method, string $paramType = null)
    {
        $this->uri = $uri;
        $this->method = $method;
    }
    
    /**
     * Create the Guzzle Request Getter.
     *
     * @param string $property
     * @return mixed
     * @throws Exception
     */
    public function __get($property)
    {
        $allowed_properties = [
            'uri',
            'method',
            'options'
        ];

        if (!in_array($property, $allowed_properties)) {
            throw new Exception("Property not avaiable");
        }

        return $this->$property;
    }

    /**
     * Add some options into the request.
     *
     * @param array $options
     * @param string $option
     * @return GuzzleRequest
     */
    public function addOption(array $options, string $option = null): GuzzleRequest
    {
        $this->options[$option] = array_merge($this->options[$option] ?? [], $options);
        return $this;
    }

    /**
     * Add some params into the request.
     *
     * @param array $params
     * @param string $option
     * @return GuzzleRequest
     */
    public function addParam(array $params, string $option = null): GuzzleRequest
    {
        return $this->addOption($params, $option ?? $this->defaultParamsType[$this->method]);
    }

    /**
     * Add some headers into the request.
     *
     * @param array $headers
     * @return void
     */
    public function addHeader(array $headers)
    {
        return $this->addOption($headers, 'headers');
    }

    /**
     * Initialize a option.
     *
     * @param string $option
     * @return void
     */
    private function initializeOption(string $option)
    {
        if (!isset($this->options[$option])) {
            $this->options[$option] = [];
        }
    }
}