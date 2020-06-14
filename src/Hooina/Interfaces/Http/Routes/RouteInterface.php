<?php

namespace Hooina\Interfaces\Http\Routes;

interface RouteInterface
{
    public function getMethod(): string;

    public function getAction(): string;

    public function getController(): string;
}
