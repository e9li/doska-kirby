<?php

declare(strict_types=1);

namespace Doska\Shared;

/**
 * Locates shared files in both the monorepo and a built package.
 */
final class Files
{
    public static function toolbar(): string
    {
        return dirname(__DIR__, 2).'/assets/toolbar.js';
    }
}
