<?php

declare(strict_types=1);

namespace Componenta\Templater\App;

use Componenta\Templater\RendererInterface;
use LogicException;

final class View
{
    private static ?RendererInterface $renderer = null;

    public static function setRenderer(RendererInterface $renderer): void
    {
        self::$renderer = $renderer;
    }

    public static function render(string $template, array $params = []): string
    {
        if (self::$renderer === null) {
            throw new LogicException('View renderer is not configured.');
        }

        return self::$renderer->render($template, $params);
    }
}
