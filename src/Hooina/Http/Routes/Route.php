<?php

namespace Hooina\Http\Routes;

use Exception;
use Hooina\Enums\Base\RequestMethods;
use Hooina\Interfaces\Http\Routes\RouteInterface;

/**
 * @method static array get (string $path, string $controller, string $action)
 * @method static array post (string $path, string $controller, string $action)
 * @method static array put (string $path, string $controller, string $action)
 * @method static array patch (string $path, string $controller, string $action)
 * @method static array delete (string $path, string $controller, string $action)
 * @method static array copy (string $path, string $controller, string $action)
 * @method static array head (string $path, string $controller, string $action)
 * @method static array options (string $path, string $controller, string $action)
 * @method static array link (string $path, string $controller, string $action)
 * @method static array unlink (string $path, string $controller, string $action)
 * @method static array purge (string $path, string $controller, string $action)
 * @method static array lock (string $path, string $controller, string $action)
 * @method static array unlock (string $path, string $controller, string $action)
 * @method static array propfind (string $path, string $controller, string $action)
 * @method static array view (string $path, string $controller, string $action)
 */
class Route implements RouteInterface
{
    /**
     * Request method
     *
     * @var string $method
     */
    protected string $method;

    /**
     * Requested controller class
     *
     * @var string $controller
     */
    protected string $controller;

    /**
     * Controller action name
     *
     * @var string
     */
    protected string $action;

    /**
     * Call make method for different request methods
     *
     * @param string $name Request method type
     * @param array $arguments Route data
     *
     * @return array
     *
     * @throws Exception
     */
    public static function __callStatic($name, $arguments): array
    {
        if (RequestMethods::isKeyExist($name) === null) {
            throw new Exception('Route method not available');
        }

        return static::make(...[strtoupper($name), ...$arguments]);
    }

    /**
     * Request method getter
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Controller action getter
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Requested controller getter
     *
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * Make route
     *
     * @param string $method Request method
     * @param string $path Request path
     * @param string $controller The controller that will handle
     * @param string $action Method name in controller
     * @return array
     */
    protected static function make(string $method, string $path, string $controller, string $action): array
    {
        return [
            "$path" => [
                'method' => $method,
                'controller' => $controller,
                'action' => $action
            ]
        ];
    }
}
