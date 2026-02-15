<?php

function renderDescriptionOverlay(array $project): string {
    if (!$project['description']) return '';

    return '
        <template x-if="descOpen">
            <div>
                <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-sm font-semibold text-gray-700">' . htmlspecialchars($project['title']) . ' Description</h3>
                    <button @click="descOpen = false" class="text-gray-500 hover:text-gray-700">✕</button>
                </div>
                <div class="px-4 py-4 text-sm text-gray-700 dark:text-gray-200 max-h-64 overflow-y-auto">
                    ' . nl2br(htmlspecialchars($project['description'])) . '
                </div>
            </div>
        </template>
    ';
}