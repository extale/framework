<?php

namespace Hooina\Interfaces\Http\Routes\Factory;

use Hooina\Interfaces\Core\Factory\FactoryInterface;
use Hooina\Interfaces\Http\Requests\RequestInterface;
use Hooina\Interfaces\Http\Routes\RouteReceiverInterface;

interface RouteReceiverFactoryInterface extends FactoryInterface
{
    public function create(RequestInterface $request, array $routes): RouteReceiverInterface;
}
