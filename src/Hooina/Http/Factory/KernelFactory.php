<?php

namespace Hooina\Http\Factory;

use Hooina\Http\Kernel;
use Hooina\Http\Requests\Request;
use Hooina\Http\Requests\RequestReceiver;
use Hooina\Http\Validation\Exceptions\WrongValidatorException;
use Hooina\Http\Validation\FakeValidator;
use Hooina\Interfaces\Http\Factory\KernelFactoryInterface;
use Hooina\Interfaces\Http\KernelInterface;
use Hooina\Interfaces\Validation\ValidatorInterface;

class KernelFactory extends Kernel implements KernelFactoryInterface
{
    /**
     * Get routes from file
     *
     * @param string $routesPath
     *
     * @return array
     */
    public function getRoutes(string $routesPath): array
    {
        $list = [];

        if (is_null($routesPath)) {
            return $list;
        }

        $routes = include_once $routesPath;
        if (count($routes) === 0) {
            return $list;
        }

        if (is_array($routes) === false) {
            return $list;
        }

        foreach ($routes as $index => $route) {
            foreach ($route as $path => $params) {
                $list[$path][$params['method']] = array_values($params);
            }
        }

        return $list;
    }

    /**
     * Get middleware
     *
     * @return array
     */
    public function getMiddleware(): array
    {
        return [];
    }

    /**
     * Get validator that will be validate request
     *
     * @param array $options
     *
     * @return ValidatorInterface
     *
     * @throws WrongValidatorException
     */
    protected function getValidator(array $options): ValidatorInterface
    {
        if (is_null($options['validator'])) {
            return new FakeValidator();
        }

        if (isset(class_implements($options['validator'])[ValidatorInterface::class]) === false) {
            throw new WrongValidatorException();
        }

        return $options['validator']->create($options['rules'] ?? []);
    }

    /**
     * Get basic request
     *
     * @return Request
     */
    protected function getRequest(): Request
    {
        $requestReceiver = new RequestReceiver();

        return $requestReceiver->getRequest();
    }

    /**
     * Create an http kernel
     *
     * @param array $options
     *
     * @return KernelInterface
     *
     * @throws WrongValidatorException
     */
    public function create(array $options = []): KernelInterface
    {
        $kernel = new Kernel();

        $routes = $this->getRoutes($options['routes_path']);

        $kernel->routes = $routes;
        $kernel->request = $this->getRequest();
        $kernel->middleware = $this->getMiddleware();
        $kernel->validator = $this->getValidator($options);

        return $kernel;
    }
}
