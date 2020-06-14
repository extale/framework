<?php

namespace Hooina\Http\Controller;

use Hooina\Interfaces\Http\Controller\ControllerFactoryInterface;
use Hooina\Interfaces\Http\Controller\ControllerInterface;
use Hooina\Interfaces\Http\Routes\RouteInterface;

class ControllerFactory extends Controller implements ControllerFactoryInterface
{
    /**
     * Create controller from current route
     *
     * @param RouteInterface $route
     * @return ControllerInterface
     */
    public function create(RouteInterface $route): ControllerInterface
    {
        $controller = $route->getController();

        $controller = new $controller();

        $controller->currentAction = $route->getAction();

        return $controller;
    }
}
