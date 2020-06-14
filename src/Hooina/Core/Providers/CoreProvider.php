<?php

namespace Hooina\Core\Providers;

use Hooina\Core\Exceptions\Handler;

class CoreProvider extends Provider
{
    /**
     * Register exception handler
     */
    public function register(): void
    {
        $this->registerExceptionHandler();
    }

    /**
     * Callable exception handler
     */
    protected function registerExceptionHandler(): void
    {
        set_exception_handler(fn($exception) => new Handler($exception));
    }
}
