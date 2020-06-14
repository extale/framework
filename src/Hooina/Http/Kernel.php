<?php

namespace Hooina\Http;

use Hooina\Http\Controller\ControllerFactory;
use Hooina\Interfaces\Http\Controller\ControllerInterface;
use Hooina\Http\Requests\Factory\RequestFactory;
use Hooina\Interfaces\Http\KernelInterface;
use Hooina\Interfaces\Http\Requests\RequestInterface;
use Hooina\Http\Requests\Request;
use Hooina\Interfaces\Http\Responses\ResponseInterface;
use Hooina\Http\Routes\Factory\RouteReceiverFactory;
use Hooina\Interfaces\Http\Routes\RouteInterface;
use Hooina\Interfaces\Validation\ValidatorInterface;

class Kernel implements KernelInterface
{
    /**
     * Array of middleware
     *
     * @var array $middleware
     */
    protected array $middleware;

    /**
     * Current routes loaded from file
     *
     * @var array $routes
     */
    protected array $routes;

    /**
     * Basic request created from global variables
     *
     * @var Request $request
     */
    protected Request $request;

    /**
     * Request validator instance
     *
     * @var ValidatorInterface $validator
     */
    protected ValidatorInterface $validator;

    /**
     * Handle request
     *
     * @return ResponseInterface
     */
    public function handle(): ResponseInterface
    {
        $controller = $this->createController($this->getRoute());

        $actionRequest = $controller->getActionRequest();
        if (is_null($actionRequest)) {
            return $controller->run($this->request);
        }

        $request = $this->createChildRequest($actionRequest);

        $isValid = $request->validate($this->validator);
        if ($isValid === false) {
            return $this->validationFailedResponse($request->getErrors());
        }

        return $controller->run($request);
    }

    /**
     * Create controller that will run
     *
     * @param RouteInterface $route
     * @return ControllerInterface
     */
    protected function createController(RouteInterface $route): ControllerInterface
    {
        return (new ControllerFactory())->create($route);
    }

    /**
     * Create request form controller argument
     *
     * @param string $requestClass
     * @return RequestInterface
     */
    protected function createChildRequest(string $requestClass): RequestInterface
    {
        return (new RequestFactory($requestClass))->create([
            'method' => $this->request->getMethod(),
            'path' => $this->request->getRequestPath(),
            'parameters' => $this->request->getParameters(),
            'headers' => $this->request->getHeaders(),
            'files' => $this->request->getFiles()
        ]);
    }

    /**
     * Get current requested route
     *
     * @return RouteInterface
     */
    protected function getRoute(): RouteInterface
    {
        $routeReceiver = (new RouteReceiverFactory())->create($this->request, $this->routes);

        return $routeReceiver->getRoute();
    }

    /**
     * Return an error response
     *
     * @param array $errors
     * @return ResponseInterface
     */
    protected function validationFailedResponse(array $errors): ResponseInterface
    {
        return response([
            'status' => 400,
            'errors' => $errors
        ], 400);
    }
}
