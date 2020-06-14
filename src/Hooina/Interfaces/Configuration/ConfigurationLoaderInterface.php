<?php

namespace Hooina\Interfaces\Configuration;

interface ConfigurationLoaderInterface
{
    public function getConfig(string $name): array;
}
