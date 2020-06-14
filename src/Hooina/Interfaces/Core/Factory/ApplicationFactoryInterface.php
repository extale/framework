<?php

namespace Hooina\Interfaces\Core\Factory;

use Hooina\Interfaces\Core\ApplicationInterface;

interface ApplicationFactoryInterface extends FactoryInterface
{
    public function create(string $basePath, array $configuration = []): ApplicationInterface;
}
