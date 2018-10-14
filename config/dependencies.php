<?php

$containerRegistries = [];
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(__DIR__ . '/di/'),
    RecursiveIteratorIterator::SELF_FIRST
);

/** @var SplFileInfo $file */
foreach ($iterator as $file) {
    $filePath = $file->getRealPath();

    if (strpos($filePath, '.php') !== false) {
        $containerRegistries = array_merge($containerRegistries, require $filePath);
    }
}

return $containerRegistries;
