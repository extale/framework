<?php

namespace Hooina\Core\Exceptions;

use Exception;
use Throwable;

class ClassNotBindedException extends Exception
{
    public function __construct($class = "Class", $code = 501, Throwable $previous = null)
    {
        parent::__construct("$class not binded", $code, $previous);
    }
}