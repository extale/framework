<?php

if (function_exists('builder') === false) {
    function builder(string $builder, array $arguments = [])
    {
        return (new $builder(...$arguments))->produce();
    }
}

if (function_exists('response') === false) {
    function response(array $content): Hooina\Http\Responses\Response
    {
        return new Hooina\Http\Responses\Response($content);
    }
}

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
