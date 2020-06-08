<?php

namespace Hooina\Core\Builders;

use Dotenv\Dotenv;
use Hooina\Core\Application;
use Hooina\Core\Builders\Contracts\ApplicationBuilderContract;
use Hooina\Core\Providers\CoreProvider;

class ApplicationBuilder extends Application implements ApplicationBuilderContract
{
    protected Application $application;

    protected object $configuration;

    public function __construct(string $basePath, array $configuration = [])
    {
        $this->application = new Application();

        $this->application->basePath = $basePath;
        $this->configuration = (object) $configuration;

        return $this;
    }

    public function produce(): Application
    {
        $this->loadEnvVariables();

        $this->application->providers = $this->getProviders();
        $this->registerProviders();

        $this->application->builders = $this->getBuilders();

        return $this->application;
    }

    protected function registerProviders(): void
    {
        $providers = $this->application->providers;

        foreach ($providers as $provider) {
            (new $provider($this->application))->register();
        }
    }

    protected function getProviders(): array
    {
        $providers = $this->configuration->providers;

        array_unshift($providers, CoreProvider::class);

        return $providers;
    }

    protected function getBuilders(): array
    {
        return $this->configuration->builders;
    }

    protected function loadEnvVariables(): void
    {
        Dotenv::createImmutable($this->application->basePath)->load();
    }
}
