<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class ModelDiscovery
{
    /**
     * Get all model classes in app/Models.
     *
     * If $modelOnly = true, it returns only the base names (e.g. ['User', 'Product']).
     * If $modelOnly = false, it returns the full class names (e.g. ['App\Models\User', 'App\Models\Product']).
     *
     * @return array<string>
     */
    public static function all(bool $modelOnly = false): array
    {
        $modelsPath = app_path('Models');
        $namespace = 'App\\Models\\';

        return collect(File::allFiles($modelsPath))
            ->map(fn ($file) => $namespace.$file->getFilenameWithoutExtension())
            ->filter(fn ($class) => class_exists($class))
            ->map(fn ($class) => $modelOnly ? class_basename($class) : $class)
            ->values()
            ->all();
    }
}
