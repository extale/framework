<?php

namespace Hooina\Core;

use Hooina\Core\Exceptions\ClassNotFoundException;
use Hooina\Core\Exceptions\ImplementationException;
use Hooina\Core\Factories\ApplicationFactory;
use Hooina\Interfaces\Core\ApplicationInterface;

class Application implements ApplicationInterface
{
    /**
     * Core version.
     */
    protected const VERSION = '1.0.1';

    /**
     * Application configuration.
     *
     * @var array $configuration
     */
    protected array $configuration;

    /**
     * Base project folder path.
     *
     * @var string $basePath
     */
    protected string $basePath;

    /**
     * Class bindings.
     * Has array with abstraction and realisation.
     *
     * @var array $bindings
     */
    protected array $bindings;

    /**
     * Application providers.
     *
     * @var array $providers
     */
    protected array $providers;

    /**
     * Singletons instances.
     *
     * @var array $singletons
     */
    protected array $singletons;

    protected static Application $instance;

    /**
     * Show current application version.
     *
     * @return string
     */
    public function version(): string
    {
        return static::VERSION;
    }

    /**
     * Create application singleton.
     *
     * @return ApplicationInterface
     */
    public static function getInstance(): ApplicationInterface
    {
        if (empty(static::$instance)) {
            static::$instance = new ApplicationFactory();
        }

        return static::$instance;
    }

    /**
     * Make class as singleton.
     *
     * @param string $className
     * @param array $args
     *
     * @return mixed
     */
    public function singleton(string $className, array $args = [])
    {
        if (isset($this->singletons[$className]) === false) {
            $this->singletons[$className] = $this->make($className, $args);
        }

        return $this->singletons[$className];
    }

    /**
     * Create object from class name.
     *
     * @param string $class
     * @param array $args
     *
     * @return mixed
     */
    public function make(string $class, array $args = [])
    {
        if (isset($this->bindings[$class])) {
            return new $this->bindings[$class](...$args);
        }

        return new $class(...$args);
    }

    /**
     * Bind class realisation.
     *
     * @param string $abstract
     * @param string $realisation
     *
     * @throws ClassNotFoundException
     * @throws ImplementationException
     */
    public function bind(string $abstract, string $realisation): void
    {
        $this->validateBinding($abstract, $realisation);

        $this->bindings[$abstract] = $realisation;
    }

    /**
     * Get application base path.
     *
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * Validate class bindings.
     *
     * @param string $abstract Abstract class
     * @param string $realisation Realisation class
     *
     * @throws ClassNotFoundException
     * @throws ImplementationException
     */
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
