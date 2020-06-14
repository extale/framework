<?php

namespace Hooina\Configuration;

use Hooina\Configuration\Exceptions\ConfigurationNotFoundException;
use Hooina\Configuration\Exceptions\WrongConfigFormatException;
use Hooina\Interfaces\Configuration\ConfigurationLoaderInterface;

class ConfigurationLoader implements ConfigurationLoaderInterface
{
    /**
     * Path to config folder.
     *
     * @var string $configFolder
     */
    protected string $configFolder;

    public function __construct(string $configFolder)
    {
        $this->configFolder = $configFolder;
    }

    /**
     * Get configuration by name.
     *
     * @param string $name
     * @return array
     * @throws ConfigurationNotFoundException
     * @throws WrongConfigFormatException
     */
    public function getConfig(string $name): array
    {
        $config = include $this->getConfigPath($name);
        if (is_array($config) === false) {
            throw new WrongConfigFormatException(gettype($config));
        }

        return $config;
    }

    /**
     * Get config path.
     *
     * @param string $name
     * @return string
     * @throws ConfigurationNotFoundException
     */
    protected function getConfigPath(string $name): string
    {
        $configPath = "$this->configFolder/{$name}.php";

        if (file_exists($configPath) === false) {
            throw new ConfigurationNotFoundException($name);
        }

        return $configPath;
    }
}
