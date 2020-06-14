<?php

namespace Hooina\Http\Routes\Factory;

use Hooina\Http\Routes\Route;
use Hooina\Interfaces\Http\Routes\Factory\RouteFactoryInterface;
use Hooina\Interfaces\Http\Routes\RouteInterface;

class RouteFactory extends Route implements RouteFactoryInterface
{
    protected Route $route;

    public function __construct(string $method, string $controller, string $action)
    {
        $this->route = new Route();

        $this->route->method = $method;
        $this->route->controller = $controller;
        $this->route->action = $action;
    }

    public function create(): RouteInterface
    {
        return $this->route;
    }
}
