<?php

function renderActionsOverlay(array $project, string $urlGiteaServer, string $urlGithub): string {
    return '
        <template x-if="actionsOpen">
            <div>
                <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-white">Project Actions</h3>
                    <button @click="actionsOpen = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-white">✕</button>
                </div>

                <div class="px-4 py-4 flex flex-col gap-3 text-sm text-gray-700 dark:text-gray-200">

                    <a href="' . $urlGiteaServer . $project['entry'] . '" target="_blank"
                       class="flex items-center gap-2 px-3 py-2 rounded-md border dark:border-gray-600 bg-gray-50 dark:bg-gray-700 hover:bg-teal-500 hover:text-white dark:hover:bg-teal-500 dark:hover:text-white transition">
                        <span>Open in Gitea</span>
                    </a>

                    <a href="' . $urlGithub . $project['entry'] . '" target="_blank"
                       class="flex items-center gap-2 px-3 py-2 rounded-md border dark:border-gray-600 bg-gray-50 dark:bg-gray-700 hover:bg-teal-500 hover:text-white dark:hover:bg-teal-500 dark:hover:text-white transition">
                        <span>Open in GitHub</span>
                    </a>

                    <a href="vscode://file/W:/' . urlencode($project['path']) . '"
                       class="flex items-center gap-2 px-3 py-2 rounded-md border dark:border-gray-600 bg-gray-50 dark:bg-gray-700 hover:bg-teal-500 hover:text-white dark:hover:bg-teal-500 dark:hover:text-white transition">
                        <span>Open in VS Code</span>
                    </a>
                </div>
            </div>
            <div x-show="copiedRemote"
                class="text-xs text-green-600 dark:text-green-400 mt-2">
                Git remote URL copied
            </div>

        </template>
    ';
}