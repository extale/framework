<?php

namespace Hooina\Interfaces\Http\Routes;

interface RouteReceiverInterface
{
    public function getRoute(): RouteInterface;
}
