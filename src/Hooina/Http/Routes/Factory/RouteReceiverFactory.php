<?php

namespace Hooina\Http\Routes\Factory;

use Hooina\Interfaces\Http\Requests\RequestInterface;
use Hooina\Interfaces\Http\Routes\Factory\RouteReceiverFactoryInterface;
use Hooina\Interfaces\Http\Routes\RouteReceiverInterface;
use Hooina\Http\Routes\RouteReceiver;

class RouteReceiverFactory extends RouteReceiver implements RouteReceiverFactoryInterface
{
    /**
     * Crate and initialize an route receiver
     *
     * @param RequestInterface $request
     * @param array $routes
     *
     * @return RouteReceiverInterface
     */
    public function create(RequestInterface $request, array $routes): RouteReceiverInterface
    {
        $routeReceiver = new RouteReceiver();

        $routeReceiver->request = $request;
        $routeReceiver->routes = $routes;

        return $routeReceiver;
    }
}
