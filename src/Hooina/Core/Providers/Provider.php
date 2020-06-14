<?php

namespace Hooina\Core\Providers;

use Hooina\Core\Application;

abstract class Provider
{
    /**
     * Application instance.
     *
     * @var Application $app
     */
    protected Application $app;

    /**
     * Provider constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Register provider in application
     */
    abstract public function register(): void;
}
