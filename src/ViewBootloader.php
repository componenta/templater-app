<?php

declare(strict_types=1);

namespace Componenta\Templater\App;

use Componenta\App\Boot\BootContext;
use Componenta\App\Boot\BootloaderInterface;
use Componenta\App\Boot\ScopedBootloaderSupport;
use Componenta\App\Scope;
use Componenta\Scope\Scopes;
use Componenta\Templater\RendererInterface;

final readonly class ViewBootloader implements BootloaderInterface
{
    use ScopedBootloaderSupport;

    public Scopes $scopes;

    public function __construct()
    {
        $this->scopes = Scopes::of(Scope::HTTP, Scope::CLI);
    }

    public function boot(BootContext $context): void
    {
        View::setRenderer($context->container->get(RendererInterface::class));
    }

}
