<?php

function getProjectTitle(string $path): ?string {
    $readme = $path . '/README.md';
    if (!file_exists($readme)) return null;

    $lines = file($readme, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!$lines || count($lines) < 1) return null;

    return ltrim($lines[0], "# ");
}

function getProjectDescription(string $path): ?string {
    $readme = $path . '/README.md';
    if (!file_exists($readme)) return null;

    $lines = file($readme, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $lines[1] ?? null;
}