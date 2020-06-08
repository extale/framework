<?php

/** @noinspection PhpIncludeInspection */

namespace Hooina\Http\Routes\Builders;

use Hooina\Http\Routes\Builders\Contracts\RouteReceiverBuilderContract;
use Hooina\Http\Routes\Contracts\RouteReceiverContract;
use Hooina\Http\Routes\RouteReceiver;

class RouteReceiverBuilder extends RouteReceiver implements RouteReceiverBuilderContract
{
    protected RouteReceiver $routeReceiver;

    public function __construct(string $routesPath)
    {
        $this->routeReceiver = new RouteReceiver();

        $this->routeReceiver->routesPath = $routesPath;

        return $this;
    }

    public function produce(): RouteReceiverContract
    {
        $this->routeReceiver->routes = $this->getRoutes();

        return $this->routeReceiver;
    }

    protected function getRoutes(): array
    {
        $routes = include_once $this->routeReceiver->routesPath;

        $list = [];

        foreach ($routes as $index => $route) {
            foreach ($route as $path => $params) {
                $list[$path][$params['method']] = array_values($params);
            }
        }

        return $list;
    }
}
