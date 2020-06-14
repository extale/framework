<?php

if (function_exists('response') === false) {
    function response($content, int $statusCode = 200): Hooina\Http\Responses\Response
    {
        return new Hooina\Http\Responses\Response($content, $statusCode);
    }
}
