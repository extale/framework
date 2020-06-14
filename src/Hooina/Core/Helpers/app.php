<?php

use Hooina\Interfaces\Core\ApplicationInterface;

if (function_exists('class_name') === false) {
    function class_name(string $class): string
    {
        return basename(str_replace('\\', '/', $class));
    }
}

if (function_exists('env') === false) {
    function env(string $variable, string $default): string
    {
        if (($value = getenv($variable)) === false) {
            return $default;
        }

        return $value;
    }
}

if (function_exists('base_path') === false) {
    function base_path(): string
    {
        return app()->getBasePath();
    }
}

if (function_exists('app') === false) {
    function app(): ApplicationInterface
    {
        return Hooina\Core\Application::getInstance();
    }
}
