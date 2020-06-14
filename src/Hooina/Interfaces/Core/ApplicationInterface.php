<?php

namespace Hooina\Interfaces\Core;

interface ApplicationInterface
{
    public function version(): string;

    public static function getInstance(): ApplicationInterface;

    public function singleton(string $className, array $args = []);

    public function make(string $class, array $args = []);

    public function bind(string $abstract, string $realisation): void;

    public function getBasePath(): string;
}
