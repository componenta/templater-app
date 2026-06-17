<?php

declare(strict_types=1);

namespace Componenta\Templater\App\Factory;

use Componenta\Config\Config;
use Componenta\Stdlib\PathResolverInterface;
use Componenta\Templater\App\ConfigKey;
use Componenta\Templater\Engine;
use Psr\Container\ContainerInterface;

final readonly class EngineFactory
{
    public function __invoke(ContainerInterface $container): Engine
    {
        $config = $container->get(Config::class)->array(ConfigKey::ROOT, []);
        $paths = $container->get(PathResolverInterface::class);

        $engine = new Engine(
            $paths->resolve((string) ($config[ConfigKey::TEMPLATES_DIR] ?? 'templates')),
            (string) ($config[ConfigKey::EXTENSION] ?? 'phtml'),
        );

        foreach (($config[ConfigKey::FOLDERS] ?? []) as $name => $directory) {
            $engine->addFolder((string) $name, $paths->resolve((string) $directory));
        }

        foreach (($config[ConfigKey::FUNCTIONS] ?? []) as $name => $function) {
            $engine->registerFunction((string) $name, $function);
        }

        return $engine;
    }
}
