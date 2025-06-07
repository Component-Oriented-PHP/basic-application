<?php

declare(strict_types=1);

/**
 * config function
 */
function config(string $key): mixed
{
    static $configs = [];

    $parts = explode('.', $key);
    $file = array_shift($parts);

    // Load config file if not cached
    if (!isset($configs[$file])) {
        $path = __DIR__ . "/../config/{$file}.php";
        $configs[$file] = file_exists($path) ? require $path : [];
    }

    $value = $configs[$file];
    foreach ($parts as $part) {
        $value = $value[$part] ?? null;
        if ($value === null)
            break;
    }

    return $value;
}