<?php

declare(strict_types=1);

namespace Componenta\Templater\App;

final class ConfigKey extends \Componenta\Config\ConfigKey
{
    public const string ROOT = 'renderer';
    public const string TEMPLATES_DIR = 'templates_dir';
    public const string EXTENSION = 'ext';
    public const string FOLDERS = 'templates_folders';
    public const string FUNCTIONS = 'functions';
}
