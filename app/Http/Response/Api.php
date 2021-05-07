<?php

namespace App\Http\Response;

use App\Exceptions\ApiException;
use Illuminate\Http\JsonResponse;

/**
 * Used to format the HTTP API Responses.
 * 
 * HTTP Code Types:
 * 
 * Family            Type                 Description
 * -------------------------------------------------------------------------------------------------------------------------------------
 * 1xx               Informational	      Communicates transfer protocol-level information.
 * 2xx               Success              Indicates that the client’s request was accepted successfully.
 * 3xx               Redirection	      Indicates that the client must take some additional action in order to complete their request.
 * 4xx               Client Error	      This category of error status codes points the finger at clients.
 * 5xx               Server Error	      The server takes responsibility for these error status codes.
 * 
 * @source https://httpstatuses.com/ More information about Http Codes
 */
class Api
{
    /**
     * Response Http code.
     * 
     * @var array
     */
    private $code = 200;

    /**
     * 
     * Response headers.
     * 
     * @var array
     */
    private $headers = [];

    /**
     * Api Response getter.
     *
     * @param string $attribute
     * @return mixed
     */
    public function __get(string $attribute)
    {
        return $this->$attribute;
    }

    /**
     * Return the Json Response.
     *
     * @param boolean $status
     * @param string $message
     * @param mixed $data
     * @param array $content
     * @return JsonResponse
     */
    private function response(bool $status, string $message = null, $data = null, array $content = null): JsonResponse
    {
        return response()->json(
            $this->makeData($status, $message, $data, $content),
            $this->code,
            $this->headers
        );
    }

    /**
     * Format the data and remove the empty content.
     *
     * @param boolean $status
     * @param string $message
     * @param mixed $data
     * @param array $content
     * @return array
     */
    private function makeData(bool $status, string $message = null, $data = null, array $content = null): array
    {
        return array_filter(
            array_merge([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $content ?? []),
            function ($item) {
                return $item !== null;
            }
        );
    }

    /**
     * Add a code for the response.
     *
     * @param integer $code
     * @return Api
     */
    public function code(int $code): Api
    {
        if (!isHttpCode($code)) {
            throw new ApiException(__('system.apis.error.invalid_http_code', $code), 500);
        }

        $this->code = $code;
        return $this;
    }

    /**
     * Add a header for the response.
     *
     * @param string $key
     * @param string $value
     * @return Api
     */
    public function header(string $key, string $value): Api
    {
        $this->headers = array_merge($this->headers, [$key => $value]);
        return $this;
    }

    /**
     * Add multiple headers for the response.
     *
     * @param array $headers
     * @return Api
     */
    public function headers(array $headers): Api
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * Define a code and return a success response.
     *
     * @param integer $code
     * @param string $message
     * @param array $data
     * @param array $content
     * @return JsonResponse
     */
    public function success(int $code, $data = null, $content = null, string $message = null): JsonResponse
    {
        return $this->code($code)->response(true, $message, $data, $content);
    }

    /**
     * Define a code and return a error response.
     *
     * @param integer $code
     * @param string $message
     * @param array $data
     * @param array $content
     * @return JsonResponse
     */
    public function error(int $code, string $message = null, $data = null, $content = null): JsonResponse
    {
        return $this->code($code)->response(false, $message, $data, $content);
    }

    /**
     * 1×× Informational
     * =============================================
     * 
     * Code       Descriptiom
     * ---------------------------------------------
     * 100        Continue
     * 101        Switching Protocols
     * 102        Processing
     */

    //

    /**
     * 2×× Success
     * =============================================
     * 
     * Code       Descriptiom
     * ---------------------------------------------
     * 200        OK
     * 201        Created
     * 202        Accepted
     * 203        Non-authoritative Information
     * 204        No Content
     * 205        Reset Content
     * 206        Partial Content
     * 207        Multi-Status
     * 208        Already Reported
     * 226        IM Used
     */

    public function ok($data = null, array $content = null, string $message = null): JsonResponse
    {
        return $this->success(200, $data, $content, $message);
    }

    public function created($data = null, array $content = null, string $message = null): JsonResponse
    {
        return $this->success(201, $data, $content, $message);
    }

    public function accepted($data = null, array $content = null, string $message = null): JsonResponse
    {
        return $this->success(202, $data, $content, $message);
    }

    public function noContent(): JsonResponse
    {
        return $this->success(204);
    }

    public function multiStatus($data = null, array $content = null, string $message = null): JsonResponse
    {
        return $this->success(207, $data, $content, $message);
    }

    /**
     * 3×× Redirection
     * =============================================
     * 
     * Code       Descriptiom
     * ---------------------------------------------
     * 300        Multiple Choices
     * 301        Moved Permanently
     * 302        Found
     * 303        See Other
     * 304        Not Modified
     * 305        Use Proxy
     * 307        Temporary Redirect
     * 308        Permanent Redirect
     */

    //

    /**
     * 4×× Client Error
     * =============================================
     * 
     * Code       Descriptiom
     * ---------------------------------------------
     * 400        Bad Request
     * 401        Unauthorized
     * 402        Payment Required
     * 403        Forbidden
     * 404        Not Found
     * 405        Method Not Allowed
     * 406        Not Acceptable
     * 407        Proxy Authentication Required
     * 408        Request Timeout
     * 409        Conflict
     * 410        Gone
     * 411        Length Required
     * 412        Precondition Failed
     * 413        Payload Too Large
     * 414        Request-URI Too Long
     * 415        Unsupported Media Type
     * 416        Requested Range Not Satisfiable
     * 417        Expectation Failed
     * 418        I’m a teapot
     * 421        Misdirected Request
     * 422        Unprocessable Entity
     * 423        Locked
     * 424        Failed Dependency
     * 426        Upgrade Required
     * 428        Precondition Required
     * 429        Too Many Requests
     * 431        Request Header Fields Too Large
     * 444        Connection Closed Without Response
     * 451        Unavailable For Legal Reasons
     * 499        Client Closed Request
     */

    public function badRequest(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(400, $message, $data, $content);
    }

    public function unauthorized(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(401, $message, $data, $content);
    }

    public function forbidden(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(403, $message, $data, $content);
    }

    public function notFound(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(404, $message, $data, $content);
    }

    public function notAcceptable(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(406, $message, $data, $content);
    }

    public function conflict(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(409, $message, $data, $content);
    }

    public function preconditionFailed(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(412, $message, $data, $content);
    }

    public function iAmATeapot(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(418, $message, $data, $content);
    }

    public function unprocessableEntity(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(422, $message, $data, $content);
    }

    public function failedDependency(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(424, $message, $data, $content);
    }

    public function upgradeRequired(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(426, $message, $data, $content);
    }

    public function connectionClosedWithoutResponse(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(444, $message, $data, $content);
    }

    public function unavaiableForLegalReasons(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(451, $message, $data, $content);
    }

    /**
     * 5×× Server Error
     * =============================================
     * 
     * Code       Descriptiom
     * ---------------------------------------------
     * 500        Internal Server Error
     * 501        Not Implemented
     * 502        Bad Gateway
     * 503        Service Unavailable
     * 504        Gateway Timeout
     * 505        HTTP Version Not Supported
     * 506        Variant Also Negotiates
     * 507        Insufficient Storage
     * 508        Loop Detected
     * 510        Not Extended
     * 511        Network Authentication Required
     * 599        Network Connect Timeout Error
     */

    public function internalError(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(500, $message, $data, $content);
    }

    public function notImplemented(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(501, $message, $data, $content);
    }

    public function badGateway(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(502, $message, $data, $content);
    }

    public function serviceUnavaiable(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(503, $message, $data, $content);
    }

    public function gatewayTimeout(string $message, $data = null, array $content = null): JsonResponse
    {
        return $this->error(504, $message, $data, $content);
    }
    
}