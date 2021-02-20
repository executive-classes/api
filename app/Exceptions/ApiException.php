<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ApiException extends Exception
{
    /**
     * Create a new Api Exception.
     *
     * @param string $message
     * @param integer $code
     * @param Throwable $previous
     */
    public function __construct(string $message = "" , int $code = 500 , Throwable $previous = null) 
    {
        if (!isHttpCode($code, HTTP_CLIENT_ERROR, HTTP_SERVER_ERROR)) {
            $code = 500;
        }
        
        parent::__construct($message, $code, $previous);
    }
}
