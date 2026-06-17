<?php

declare(strict_types=1);

namespace Componenta\Templater\App\Factory;

use Componenta\Templater\Engine;
use Componenta\Templater\Renderer;
use Psr\Container\ContainerInterface;

final readonly class RendererFactory
{
    public function __invoke(ContainerInterface $container): Renderer
    {
        return new Renderer($container->get(Engine::class));
    }
}
