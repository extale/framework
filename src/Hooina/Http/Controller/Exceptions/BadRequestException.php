<?php

namespace Hooina\Http\Controller\Exceptions;

use Throwable;
use Exception;

class BadRequestException extends Exception
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, 500, $previous);
    }
}
