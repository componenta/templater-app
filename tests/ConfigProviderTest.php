<?php

declare(strict_types=1);

use Componenta\App\ConfigKey as AppConfigKey;
use Componenta\Config\ConfigKey as DependencyConfigKey;
use Componenta\Templater\App\ConfigProvider;
use Componenta\Templater\App\Factory\EngineFactory;
use Componenta\Templater\App\Factory\RendererFactory;
use Componenta\Templater\App\ViewBootloader;
use Componenta\Templater\Engine;
use Componenta\Templater\RendererInterface;

it('registers templating services without a legacy autowire section', function (): void {
    $config = (new ConfigProvider())();

    expect($config[AppConfigKey::BOOTLOADERS])->toBe([ViewBootloader::class])
        ->and($config[DependencyConfigKey::DEPENDENCIES])->not->toHaveKey(DependencyConfigKey::AUTOWIRES)
        ->and($config[DependencyConfigKey::DEPENDENCIES][DependencyConfigKey::FACTORIES])->toBe([
            Engine::class => EngineFactory::class,
            RendererInterface::class => RendererFactory::class,
        ]);
});
