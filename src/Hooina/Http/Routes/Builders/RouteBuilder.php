<?php

namespace Hooina\Http\Routes\Builders;

use Hooina\Http\Routes\Builders\Contracts\RouteBuilderContract;
use Hooina\Http\Routes\Route;

class RouteBuilder extends Route implements RouteBuilderContract
{
    protected Route $route;

    public function __construct(string $method, string $controller, string $action)
    {
        $this->route = new Route();

        $this->route->method = $method;
        $this->route->controller = $controller;
        $this->route->action = $action;
    }

    public function produce(): Route
    {
        return $this->route;
    }
}
