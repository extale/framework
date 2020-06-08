<?php

namespace Hooina\Http\Routes\Builders\Contracts;

use Hooina\Http\Routes\Route;

interface RouteBuilderContract
{
    public function produce(): Route;
}
