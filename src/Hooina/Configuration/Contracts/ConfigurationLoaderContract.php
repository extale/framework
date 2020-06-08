<?php

namespace Hooina\Configuration\Contracts;

interface ConfigurationLoaderContract
{
    public function getConfig(string $name): array;
}
