<?php

namespace Hooina\Http\Routes\Exceptions;

use Exception;
use Throwable;

class RouteNotFoundException extends Exception
{
    public function __construct($path, $code = 404, Throwable $previous = null)
    {
        parent::__construct("Route for path {$path} not found", $code, $previous);
    }
}
