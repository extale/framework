<?php

namespace Hooina\Http;

use Hooina\Http\Requests\Contracts\RequestReceiverContract;
use Hooina\Http\Contracts\KernelContract;
use Hooina\Http\Responses\Contracts\ResponseContract;
use Hooina\Http\Routes\Contracts\RouteReceiverContract;

class Kernel implements KernelContract
{
    protected RequestReceiverContract $requestReceiver;

    protected RouteReceiverContract $routeReceiver;

    protected string $basePath;

    protected string $controller;

    protected array $arguments;

    protected object $options;

    public function handle(): ResponseContract
    {
        $request = $this->requestReceiver->getRequest();

        $route = $this->routeReceiver->getRoute($request);

        return $route->run($request);
    }
}
