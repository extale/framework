<?php

namespace Hooina\Http\Controller;

use Hooina\Http\Controller\Exceptions\BadRequestException;
use Hooina\Http\Controller\Exceptions\UndefinedActionException;
use Hooina\Interfaces\Http\Controller\ControllerInterface;
use Hooina\Interfaces\Http\Requests\RequestInterface;
use Hooina\Interfaces\Http\Responses\ResponseInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionParameter;

class Controller implements ControllerInterface
{
    /**
     * Action that will be run
     *
     * @var string $currentAction
     */
    protected string $currentAction;

    /**
     * Run controller action
     *
     * @param RequestInterface|null $request
     *
     * @return ResponseInterface
     */
    public function run(RequestInterface $request = null): ResponseInterface
    {
        $action = $this->currentAction;

        return $this->$action($request);
    }

    /**
     * Get request from controller arguments
     *
     * @return string|null
     *
     * @throws BadRequestException
     * @throws UndefinedActionException
     *
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function getActionRequest(): ?string
    {
        $arguments = $this->getArguments();

        if (isset($arguments[0]) === false) {
            return null;
        }

        $argumentType = $arguments[0]->getType();
        if (is_null($argumentType)) {
            throw new BadRequestException("Untyped controller property '" . $arguments[0]->getName() . "'");
        }

        if ($argumentType->isBuiltin()) {
            throw new BadRequestException("Only request can be passed as controller argument");
        }

        $requestClass = $argumentType->getName();
        if (class_implements($requestClass)[RequestInterface::class] === false) {
            throw new BadRequestException("Request class $requestClass not implement RequestInterface");
        }

        return $requestClass;
    }

    /**
     * Get arguments from action
     *
     * @return ReflectionParameter[]
     *
     * @throws UndefinedActionException
     */
    protected function getArguments()
    {
        try {
            return (new ReflectionClass(static::class))
                ->getMethod($this->currentAction)
                ->getParameters();
        } catch (ReflectionException $exception) {
            throw new UndefinedActionException($this->currentAction . " action not found in controller.");
        }
    }
}
