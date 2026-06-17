# Componenta Templater App

Application integration for `componenta/templater`. It registers the template engine, renderer, bootloader, static `View` helper, and global `view()` function.

## Installation

```bash
composer require componenta/templater-app
```

The package exposes `Componenta\Templater\App\ConfigProvider` through Composer metadata and autoloads `src/functions.php`.

## Registered Services

`Componenta\Templater\App\ConfigProvider` registers:

| Service or key | Registration |
|---|---|
| `Componenta\Templater\Engine` | `EngineFactory`, using template config and `PathResolverInterface`. |
| `Componenta\Templater\RendererInterface` | `RendererFactory`, wrapping the registered engine. |
| `ViewBootloader` | Autowired bootloader. |
| `AppConfigKey::BOOTLOADERS` | Adds `ViewBootloader` so `View` receives the renderer during application boot. |

## Configuration

Template settings are read from the `renderer` config section:

```php
use Componenta\Templater\App\ConfigKey;

return [
    ConfigKey::ROOT => [
        ConfigKey::TEMPLATES_DIR => 'templates',
        ConfigKey::EXTENSION => 'phtml',
        ConfigKey::FOLDERS => [
            'mail' => 'templates/mail',
        ],
        ConfigKey::FUNCTIONS => [
            'asset' => static fn(string $path): string => '/assets/' . ltrim($path, '/'),
        ],
    ],
];
```

Paths are resolved through `PathResolverInterface`. The default template directory is `templates`, and the default extension is `phtml`.

## Runtime Behavior

`ViewBootloader` runs in HTTP and CLI scopes. It gets `RendererInterface` from the container and installs it into `View::setRenderer()`. After boot, code can call:

```php
echo view('welcome', ['name' => 'Componenta']);
echo Componenta\Templater\App\View::render('welcome');
```

Calling `view()` or `View::render()` before the bootloader runs throws `LogicException`.

## Boundary

The package wires templates into an application. The renderer implementation itself lives in `componenta/templater`; path resolution lives in `componenta/path-resolver`.
