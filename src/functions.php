<?php

declare(strict_types=1);

use Componenta\Templater\App\View;

if (!function_exists('view')) {
    function view(string $template, array $params = []): string
    {
        return View::render($template, $params);
    }
}
