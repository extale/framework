<?php

namespace Hooina\Interfaces\Http\Controller;

use Hooina\Interfaces\Http\Routes\RouteInterface;

interface ControllerFactoryInterface
{
    public function create(RouteInterface $route): ControllerInterface;
}
