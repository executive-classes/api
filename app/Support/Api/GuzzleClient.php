<?php

namespace App\Support\Api;

use App\Exceptions\ApiException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

abstract class GuzzleClient
{
    /**
     * The Guzzle Client.
     * 
     * @var Client
     */
    private $_client;

    /**
     * The current request data.
     * 
     * @var GuzzleRequest
     */
    private $_request;

    /**
     * The default uri.
     * 
     * @var string
     */
    private $uri;

    /**
     * The request headers.
     *
     * @var array
     */
    private $headers = [];

    /**
     * Create the Guzzle Client.
     */
    public function __construct()
    {
        $this->_setCredentials();

        $this->_client = new Client([
            'base_uri' => $this->uri,
        ]);

        $this->_auth();
    }

    /**
     * Set the credentials.
     *
     * @return void
     */
    abstract protected function _setCredentials(): void;

    /**
     * Do the authentication.
     *
     * @return void
     */
    protected function _auth(): void
    {
        // Auth
    }

    /**
     * Throw a request error.
     *
     * @param GuzzleResponse $response
     * @return Exception
     */
    protected function _throw(GuzzleResponse $response): Exception
    {
        $message = $response->error->message;
        return new ApiException($message, $response->code());
    }

    /**
     * Set the URI.
     *
     * @param string $uri
     * @return void
     */
    protected function _setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * Add a header into the client.
     *
     * @param array $headers
     * @return void
     */
    protected function _headers(array $headers): void
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * Create a request.
     *
     * @param string $uri
     * @param string $method
     * @return void
     */
    protected function request(string $uri, string $method): GuzzleClient
    {
        $this->_request = new GuzzleRequest($uri, $method);
        return $this;
    }

    /**
     * Add a param into the request.
     *
     * @param array $params
     * @param string $option
     * @return GuzzleClient
     */
    protected function params(array $params, string $option = null): GuzzleClient
    {
        $this->_request->addParam($params, $option);
        return $this;
    }

    /**
     * Add a param if satisfy the condition.
     *
     * @param boolean $condition
     * @param array $params
     * @param string $option
     * @return GuzzleClient
     */
    protected function paramsIf(bool $condition, array $params, string $option = null): GuzzleClient
    {
        if ($condition) {
            return $this->params($params, $option);
        }
        
        return $this;
    }

    /**
     * Add a header into the request.
     *
     * @param array $headers
     * @return GuzzleClient
     */
    protected function headers(array $headers): GuzzleClient
    {
        $this->_request->addHeader($headers);
        return $this;
    }

    /**
     * Send and get the response of a request.
     *
     * @return GuzzleResponse
     */
    protected function send(): GuzzleResponse
    {
        $this->headers($this->headers);

        try {
            $response = $this->_client->request($this->_request->method, $this->_request->uri, $this->_request->options);
        } catch (ClientException $e) {
            throw $this->_throw($this->response($e->getResponse()));
        }

        return $this->response($response);
    }

    /**
     * Make the response of a request.
     *
     * @param ResponseInterface $response
     * @return GuzzleResponse
     */
    private function response(ResponseInterface $response): GuzzleResponse
    {
        $content = json_decode($response->getBody()->getContents());
        return new GuzzleResponse($response->getStatusCode(), $content);
    }

    /**
     * Create a GET request.
     *
     * @param string $uri
     * @return GuzzleClient
     */
    protected function get(string $uri): GuzzleClient
    {
        return $this->request($uri, GuzzleRequest::GET);
    }

    /**
     * Create a POST request.
     *
     * @param string $uri
     * @return GuzzleClient
     */
    protected function post(string $uri): GuzzleClient
    {
        return $this->request($uri, GuzzleRequest::POST);
    }

    /**
     * Create a PUT request.
     *
     * @param string $uri
     * @return GuzzleClient
     */
    protected function put(string $uri): GuzzleClient
    {
        return $this->request($uri, GuzzleRequest::PUT);
    }

    /**
     * Create a PATCH request.
     *
     * @param string $uri
     * @return GuzzleClient
     */
    protected function patch(string $uri): GuzzleClient
    {
        return $this->request($uri, GuzzleRequest::PATCH);
    }

    /**
     * Create a DELETE request.
     *
     * @param string $uri
     * @return GuzzleClient
     */
    protected function delete(string $uri): GuzzleClient
    {
        return $this->request($uri, GuzzleRequest::DELETE);
    }

    /**
     * Add a QUERY type param.
     *
     * @param array $params
     * @return GuzzleClient
     */
    protected function query(array $params): GuzzleClient
    {
        return $this->params($params, GuzzleRequest::QUERY);
    }

    /**
     * Add a FORM PARAMS type param.
     *
     * @param array $params
     * @return GuzzleClient
     */
    protected function formParams(array $params): GuzzleClient
    {
        return $this->params($params, GuzzleRequest::FORM_PARAMS);
    }

    /**
     * Add a JSON type param.
     *
     * @param array $params
     * @return GuzzleClient
     */
    protected function json(array $params): GuzzleClient
    {
        return $this->params($params, GuzzleRequest::JSON);
    }

    /**
     * Add a BODY type param.
     *
     * @param array $params
     * @return GuzzleClient
     */
    protected function body(array $params): GuzzleClient
    {
        return $this->params($params, GuzzleRequest::BODY);
    }

    /**
     * Add a MULTIPART type param.
     *
     * @param array $params
     * @return GuzzleClient
     */
    protected function files(array $params): GuzzleClient
    {
        return $this->params($params, GuzzleRequest::MULTIPART);
    }

}