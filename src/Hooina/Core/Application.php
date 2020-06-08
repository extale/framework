<?php

/** @noinspection
 *
 * PhpIncludeInspection
 * PhpUnhandledExceptionInspection
 */

namespace Hooina\Core;

use Hooina\Core\Builders\Exceptions\BuilderNotFoundException;
use Hooina\Core\Exceptions\ClassNotFoundException;
use Hooina\Core\Exceptions\ImplementationException;

class Application
{
    protected const VERSION = '1.0.0';

    protected string $basePath;

    protected array $bindings;

    protected array $builders;

    protected array $providers;

    public function version(): string
    {
        return static::VERSION;
    }

    public function make(string $class, array $args = [])
    {
        if (isset($this->bindings[$class])) {
            return new $this->bindings[$class](...$args);
        }

        return new $class(...$args);
    }

    public function bind(string $abstract, string $realisation): void
    {
        $this->validateBinding($abstract, $realisation);

        $this->bindings[$abstract] = $realisation;
    }

    public function build(string $name, array $arguments = [])
    {
        if (isset($this->builders[$name]) === false) {
            throw new BuilderNotFoundException($name);
        }

        return ($this->make($this->builders[$name], [...$arguments]))->produce();
    }

    protected function validateBinding(string $abstract, string $realisation): void
    {
        if (class_exists($abstract) === false && interface_exists($abstract) === false) {
            throw new ClassNotFoundException($abstract);
        }

        if (class_exists($realisation) === false) {
            throw new ClassNotFoundException($realisation);
        }

        if (isset(class_implements($realisation)[$abstract]) === false) {
            throw new ImplementationException($realisation, $abstract);
        }
    }
}
