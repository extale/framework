<?php

namespace Hooina\Interfaces\Http\Routes\Factory;

use Hooina\Interfaces\Core\Factory\FactoryInterface;
use Hooina\Interfaces\Http\Routes\RouteInterface;

interface RouteFactoryInterface extends FactoryInterface
{
    public function create(): RouteInterface;
}
