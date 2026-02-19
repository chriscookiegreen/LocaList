<?php

require_once __DIR__ . '/../data/project-info.php';
require_once __DIR__ . '/card.php';

function renderAllProjectCards(string $directory): string {
    $entries = scandir($directory);
    $html = '';
    $sortMode = $_GET['sort'] ?? 'name_asc';

    $projects = [];

    // 1. Collect all project info
    foreach ($entries as $entry) {
        if ($entry === '.' || $entry === '..' || str_starts_with($entry, '.') || 
            $entry === 'includes' || $entry === 'System Volume Information') {
            continue;
        }

        $path = $directory . $entry;
        if (!is_dir($path)) continue;

        $projects[] = getProjectInfo($entry, $directory);
    }

    // 2. Sort the projects
    switch ($sortMode) {
    case 'name_asc':
        usort($projects, fn($a, $b) => $a['title'] <=> $b['title']);
        break;

    case 'name_desc':
        usort($projects, fn($a, $b) => $b['title'] <=> $a['title']);
        break;

    case 'modified':
        usort($projects, fn($a, $b) => ($b['modified'] ?? 0) <=> ($a['modified'] ?? 0));
        break;

    case 'created_asc':
        usort($projects, fn($a, $b) => ($a['created'] ?? 0) <=> ($b['created'] ?? 0));
        break;
}


    // 3. Render sorted cards
    foreach ($projects as $project) {
        $html .= renderProjectCard($project, $GLOBALS['urlGiteaServer'], $GLOBALS['urlGithub']);
    }

    return $html;
}