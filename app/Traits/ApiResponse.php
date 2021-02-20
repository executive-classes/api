<?php

namespace App\Traits;

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
trait ApiResponse
{
    /**
     * Return the default success response.
     *
     * @param mixed $data
     * @param integer $code
     * @param array $headers
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function successResponse($data, int $code = 200, array $headers = [])
    {
        return response()->json(['status' => true, 'data' => $data], $code, $headers);
    }

    /**
     * Return the default error response.
     *
     * @param string $error
     * @param integer $code
     * @param array $headers
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function errorResponse(string $error, int $code = 500, array $headers = [])
    {
        return response()->json(['status' => false, 'error' => $error], $code, $headers);
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

    public function okResponse($data, array $headers = [])
    {
        return $this->successResponse($data, 200, $headers);
    }

    public function createdResponse($data, array $headers = [])
    {
        return $this->successResponse($data, 201, $headers);
    }

    public function acceptedResponse($data, array $headers = [])
    {
        return $this->successResponse($data, 202, $headers);
    }

    public function noContentResponse(array $headers = [])
    {
        return $this->successResponse(null, 204, $headers);
    }

    public function multiStatusResponse($data, array $headers = [])
    {
        return $this->successResponse($data, 207, $headers);
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

    public function badRequestResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 400, $headers);
    }

    public function unauthorizedResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 401, $headers);
    }

    public function forbiddenResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 403, $headers);
    }

    public function notAcceptableResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 403, $headers);
    }

    public function conflictResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 409, $headers);
    }

    public function preconditionFailedResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 412, $headers);
    }

    public function iAmATeapotResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 418, $headers);
    }

    public function unprocessableEntityResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 422, $headers);
    }

    public function failedDependencyResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 424, $headers);
    }

    public function upgradeRequiredResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 426, $headers);
    }

    public function connectionClosedWithoutResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 444, $headers);
    }

    public function unavaiableForLegalReasonsResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 451, $headers);
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

    public function internalErrorResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 500, $headers);
    }

    public function notImplementedResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 501, $headers);
    }

    public function badGatewayResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 502, $headers);
    }

    public function serviceUnavaiableResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 503, $headers);
    }

    public function gatewayTimeoutResponse($error, array $headers = [])
    {
        return $this->errorResponse($error, 504, $headers);
    }

}

