<?php

namespace Hooina\Core\Providers;

class CoreProvider extends Provider
{
    public function register(): void
    {
        $this->registerExceptionHandler();
    }

    protected function registerExceptionHandler(): void
    {
        set_exception_handler(fn($exception) => new \Hooina\Core\Exceptions\Handler($exception));
    }
}
