<?php

namespace Hooina\Core\Factories;

use Dotenv\Dotenv;
use Hooina\Core\Application;
use Hooina\Interfaces\Core\Factory\ApplicationFactoryInterface;
use Hooina\Core\Providers\CoreProvider;
use Hooina\Interfaces\Core\ApplicationInterface;

class ApplicationFactory extends Application implements ApplicationFactoryInterface
{
    /**
     * Create an application with initialized properties.
     *
     * @param string $basePath Base project path
     * @param array $configuration Array of application settings
     *
     * @return ApplicationInterface
     */
    public function create(string $basePath, array $configuration = []): ApplicationInterface
    {
        $application = new Application();

        $application->basePath = $basePath;

        $application->configuration = $configuration;

        if (file_exists("$basePath/.env")) {
            Dotenv::createImmutable($basePath)->load();
        }

        $application->providers = $this->getProviders();
        $this->registerProviders($application);

        $application::$instance = $application;

        return $application;
    }

    /**
     * Register providers.
     *
     * @param Application $app
     */
    protected function registerProviders(Application $app): void
    {
        foreach ($app->providers as $provider) {
            (new $provider($app))->register();
        }
    }

    /**
     * Get base providers.
     *
     * @param array $providers
     *
     * @return array
     */
    protected function getProviders(array $providers = []): array
    {
        array_unshift($providers, CoreProvider::class);

        return $providers;
    }
}
