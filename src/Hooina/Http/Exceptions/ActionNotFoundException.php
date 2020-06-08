<?php

namespace Hooina\Http\Exceptions;

use Exception;
use Throwable;

class ActionNotFoundException extends Exception
{
    public function __construct($message = "Action not found in this route", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
