<?php

function renderDescriptionBlock(array $project): string {
    if ($project['description']) {

        return '
            <div class="relative h-16 text-sm text-gray-500 dark:text-gray-300">
                <div class="h-full overflow-hidden pr-2">
                    ' . nl2br(htmlspecialchars($project['description'])) . '
                </div>
                <div class="pointer-events-none absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-b from-transparent to-white dark:to-gray-800"></div>
                <button x-show="showReadMore"
                        @click="descOpen = !descOpen"
                        class="absolute bottom-1 left-1/2 -translate-x-1/2 px-3 py-3 text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-teal-500 dark:hover:bg-teal-500 hover:text-white rounded-md transition">
                    Read Description
                </button>
            </div>

        ';
    }

    return '
        <div class="h-full flex items-center">
            <div class="h-12 rounded-md bg-yellow-50 border border-yellow-200 mt-1 px-4 py-3 text-sm text-yellow-800 flex items-center justify-between">
                <strong>This project has no description.</strong> Please add one to your README.md file.
            </div>
        </div>
    ';
}