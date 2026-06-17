<?php

declare(strict_types=1);

namespace Componenta\Templater\App;

use Componenta\App\ConfigKey as AppConfigKey;
use Componenta\Config\ConfigProvider as BaseConfigProvider;
use Componenta\Templater\App\Factory\EngineFactory;
use Componenta\Templater\App\Factory\RendererFactory;
use Componenta\Templater\Engine;
use Componenta\Templater\RendererInterface;

final class ConfigProvider extends BaseConfigProvider
{
    protected function getFactories(): array
    {
        return [
            Engine::class => EngineFactory::class,
            RendererInterface::class => RendererFactory::class,
        ];
    }

    protected function getAutowires(): array
    {
        return [
            ViewBootloader::class,
        ];
    }

    protected function getConfig(): array
    {
        return [
            AppConfigKey::BOOTLOADERS => [
                ViewBootloader::class,
            ],
        ];
    }
}
