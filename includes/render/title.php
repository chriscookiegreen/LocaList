<?php

function renderTitle(array $project): string {
    if ($project['title']) {
        return "
            <h2 class='text-xl font-semibold text-gray-900 dark:text-white truncate'>
                " . htmlspecialchars($project['title']) . "
            </h2>
        ";
    }

    return "
        <div class='h-18 rounded-md bg-yellow-50 border border-yellow-200 mt-1 px-4 py-3 text-sm text-yellow-800 flex'>
            <strong>No title.</strong> Please add a title to your README.md file.
        </div>
    ";
}