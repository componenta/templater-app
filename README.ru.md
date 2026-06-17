# Componenta Templater App

Интеграция `componenta/templater` с приложением. Пакет регистрирует шаблонный движок, рендерер, загрузчик, статический помощник `View` и глобальную функцию `view()`.

## Установка

```bash
composer require componenta/templater-app
```

Пакет публикует `Componenta\Templater\App\ConfigProvider` через метаданные Composer и автозагружает `src/functions.php`.

## Регистрируемые сервисы

`Componenta\Templater\App\ConfigProvider` регистрирует:

| Сервис или ключ | Регистрация |
|---|---|
| `Componenta\Templater\Engine` | `EngineFactory`, использует конфиг шаблонов и `PathResolverInterface`. |
| `Componenta\Templater\RendererInterface` | `RendererFactory`, оборачивает зарегистрированный движок. |
| `ViewBootloader` | Автоматически собираемый загрузчик. |
| `AppConfigKey::BOOTLOADERS` | Добавляет `ViewBootloader`, чтобы `View` получил рендерер при старте приложения. |

## Конфигурация

Настройки шаблонов читаются из секции `renderer`:

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

Пути разрешаются через `PathResolverInterface`. Каталог шаблонов по умолчанию — `templates`, расширение по умолчанию — `phtml`.

## Поведение

`ViewBootloader` работает в HTTP- и CLI-областях. Он получает `RendererInterface` из контейнера и устанавливает его в `View::setRenderer()`. После загрузки можно вызывать:

```php
echo view('welcome', ['name' => 'Componenta']);
echo Componenta\Templater\App\View::render('welcome');
```

Вызов `view()` или `View::render()` до выполнения загрузчика бросает `LogicException`.

## Граница пакета

Пакет подключает шаблоны к приложению. Сама реализация рендерера находится в `componenta/templater`; разрешение путей находится в `componenta/path-resolver`.
