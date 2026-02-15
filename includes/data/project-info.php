<?php

require_once __DIR__ . '/readme.php';
require_once __DIR__ . '/preview.php';
require_once __DIR__ . '/tech.php';
require_once __DIR__ . '/git.php';

function getProjectInfo(string $entry, string $directory): array {
    $path = $directory . $entry;

    return [
        'entry'       => $entry,
        'path'        => $path,
        'title'       => getProjectTitle($path),
        'description' => getProjectDescription($path),
        'preview'     => getProjectPreview($path),
        'tech'        => getProjectTechStack($path),
        'git'         => getGitDetails($path),
    ];
}

