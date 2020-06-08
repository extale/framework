<?php

namespace Hooina\Http\Routes\Contracts;

use Hooina\Http\Requests\Request;
use Hooina\Http\Routes\Route;

interface RouteReceiverContract
{
    public function getRoute(Request $request): Route;
}
