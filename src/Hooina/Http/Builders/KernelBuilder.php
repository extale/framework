<?php

namespace Hooina\Http\Builders;

use Hooina\Http\Builders\Contracts\KernelBuilderContract;
use Hooina\Http\Contracts\KernelContract;
use Hooina\Http\Kernel;
use Hooina\Http\Requests\Builders\RequestReceiverBuilder;
use Hooina\Http\Requests\Contracts\RequestReceiverContract;
use Hooina\Http\Routes\Builders\RouteReceiverBuilder;
use Hooina\Http\Routes\Contracts\RouteReceiverContract;

class KernelBuilder extends Kernel implements KernelBuilderContract
{
    protected Kernel $kernel;

    public function __construct(string $basePath, array $options = [])
    {
        $this->kernel = new Kernel();

        $this->kernel->basePath = $basePath;
        $this->kernel->options = (object) $options;

        return $this;
    }

    public function produce(): KernelContract
    {
        $this->kernel->requestReceiver = $this->getRequestReceiver($this->kernel->basePath);
        $this->kernel->routeReceiver = $this->getRouteReceiver($this->kernel->options->routes_path);

        return $this->kernel;
    }

    protected function getRouteReceiver(string $routesPath): RouteReceiverContract
    {
        return (new RouteReceiverBuilder($routesPath))->produce();
    }

    protected function getRequestReceiver(string $basePath): RequestReceiverContract
    {
        return (new RequestReceiverBuilder($basePath))->produce();
    }
}
