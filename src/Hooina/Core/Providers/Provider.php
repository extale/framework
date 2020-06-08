<?php

namespace Hooina\Core\Providers;

use Hooina\Core\Application;

abstract class Provider
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    abstract public function register(): void;
}
