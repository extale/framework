<?php

namespace Hooina\Http\Routes;

use Hooina\Http\Requests\Contracts\RequestContract;
use Hooina\Http\Routes\Contracts\RouteContract;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
class Route implements RouteContract
{
    protected string $method;

    protected string $controller;

    protected string $action;

    protected static array $availableMethods = [
        'get',
        'post',
        'put',
        'patch',
        'delete',
        'copy',
        'head',
        'options',
        'link',
        'unlink',
        'purge',
        'lock',
        'unlock',
        'propfind',
        'view'
    ];

    public static function __callStatic($name, $arguments): array
    {
        if (isset(static::$availableMethods) === false) {
            throw new MethodNotAllowedHttpException(static::$availableMethods);
        }

        return static::make(...[strtoupper($name), ...$arguments]);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function run(RequestContract $request)
    {
        $action = $this->action;

        $controller = new $this->controller();

        return $controller->$action($request);
    }

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
