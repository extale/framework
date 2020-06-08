<?php

namespace Hooina\Core\Exceptions;

use Exception;
use Throwable;

class ClassNotFoundException extends Exception
{
    public function __construct($name = "", $code = 501, Throwable $previous = null)
    {
        parent::__construct("Class {$name} not found", $code, $previous);
    }
}