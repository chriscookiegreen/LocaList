<?php

require_once __DIR__ . '/../data/project-info.php';
require_once __DIR__ . '/card.php';

function renderAllProjectCards(string $directory): string {
    $entries = scandir($directory);
    $html = '';

    foreach ($entries as $entry) {
        if ($entry === '.' || $entry === '..' || str_starts_with($entry, '.') || $entry === 'includes'|| $entry === 'System Volume Information') {
            continue;
        }

        $path = $directory . $entry;
        if (!is_dir($path)) continue;

        $project = getProjectInfo($entry, $directory);

        $html .= renderProjectCard($project, $GLOBALS['urlGiteaServer'], $GLOBALS['urlGithub']);
    }

    return $html;
}