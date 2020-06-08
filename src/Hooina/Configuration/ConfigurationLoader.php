<?php

/** @noinspection
 *
 * PhpIncludeInspection
 * PhpUnhandledExceptionInspection
 */

namespace Hooina\Configuration;

use Hooina\Configuration\Contracts\ConfigurationLoaderContract;
use Hooina\Configuration\Exceptions\ConfigurationNotFoundException;
use Hooina\Configuration\Exceptions\WrongConfigFormatException;

class ConfigurationLoader implements ConfigurationLoaderContract
{
    protected string $configFolder;

    public function __construct(string $configFolder)
    {
        $this->configFolder = $configFolder;
    }

    public function getConfig(string $name): array
    {
        $config = include $this->getConfigPath($name);
        if (is_array($config) === false) {
            throw new WrongConfigFormatException(gettype($config));
        }

        return $config;
    }

    protected function getConfigPath(string $name): string
    {
        $configPath = "$this->configFolder/{$name}.php";

        if (file_exists($configPath) === false) {
            throw new ConfigurationNotFoundException($name);
        }

        return $configPath;
    }
}
