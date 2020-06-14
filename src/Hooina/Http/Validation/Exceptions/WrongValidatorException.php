<?php

namespace Hooina\Http\Validation\Exceptions;

use Exception;
use Throwable;

class WrongValidatorException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Wrong validator used', 500, $previous);
    }
}
