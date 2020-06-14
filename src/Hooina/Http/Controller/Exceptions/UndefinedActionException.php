<?php

namespace Hooina\Http\Controller\Exceptions;

use Exception;
use Throwable;

class UndefinedActionException extends Exception
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
