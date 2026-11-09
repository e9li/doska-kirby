<?php

declare(strict_types=1);

use Doska\Kirby\Plugin;
use Kirby\Cms\App;

// A built package contains the shared classes in src/. In the monorepo they
// remain in shared/src/, also when a path install symlinks this directory.
$shared = __DIR__.'/src';
if (!is_file($shared.'/Shared/Files.php')) {
    $shared = dirname(__DIR__, 2).'/shared/src';
}

spl_autoload_register(static function (string $class) use ($shared): void {
    $map = [
        'Doska\\Kirby\\' => __DIR__.'/src/',
        'Doska\\Mcp\\' => $shared.'/Mcp/',
        'Doska\\Notes\\' => $shared.'/Notes/',
        'Doska\\Shared\\' => $shared.'/Shared/',
        'Doska\\Twig\\' => $shared.'/Twig/',
    ];
    foreach ($map as $prefix => $dir) {
        if (!str_starts_with($class, $prefix)) {
            continue;
        }
        $file = $dir.str_replace('\\', '/', substr($class, strlen($prefix))).'.php';
        if (is_file($file)) {
            require $file;

            return;
        }
    }
});

App::plugin('doska/kirby', Plugin::definition());
