<?php

namespace Hooina\Http\Routes\Builders\Contracts;

use Hooina\Http\Routes\Contracts\RouteReceiverContract;

interface RouteReceiverBuilderContract
{
    public function produce(): RouteReceiverContract;
}
