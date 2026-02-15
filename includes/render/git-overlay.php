<?php

function renderGitOverlay(array $project): string {
    if (!$project['git']['isRepo']) return '';

    $git = $project['git'];

    // Build ahead/behind badges
    $aheadBadge  = $git['ahead']  > 0 ? '<span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">↑ ' . $git['ahead'] . ' ahead</span>' : '<span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">↑ 0 ahead</span>';
    $behindBadge = $git['behind'] > 0 ? '<span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">↓ ' . $git['behind'] . ' behind</span>' : '<span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">↓ 0 behind</span>';

    // Cleanliness
    $clean = trim($git['status']) === '' ? 'Clean working tree' : 'Uncommitted changes present';

    return '
        <template x-if="gitOpen">
            <div>
                <div class="px-4 py-3 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-white"><?= htmlspecialchars($title) ?>Repository Details</h3>
                </div>

                <div class="px-4 py-4 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">Current Branch</div>
                        <div class="mt-1 text-gray-600 dark:text-gray-400"> ' . htmlspecialchars($git['branch']) . '</div>
                    </div>

                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">Total Commits</div>
                        <div class="mt-1 text-gray-600 dark:text-gray-400">' . htmlspecialchars($git['totalCommits']) . '</div>
                    </div>

                    <div class="md:col-span-2">
                        <div class="font-medium text-gray-900 dark:text-white">Last Commit</div>
                        <div class="mt-1 text-gray-600 dark:text-white space-y-1">
                            <div><span class="font-semibold dark:text-gray-400">Author:</span> ' . htmlspecialchars($git['lastAuth']) . '</div>
                            <div><span class="font-semibold dark:text-gray-400">Date:</span> ' . htmlspecialchars($git['lastDate']) . '</div>
                            <div><span class="font-semibold dark:text-gray-400">Message:</span> ' . htmlspecialchars($git['lastMsg']) . '</div>
                        </div>
                    </div>

                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">Sync Status</div>
                        <div class="mt-1 text-gray-600 flex items-center gap-2">
                            ' . $aheadBadge . $behindBadge . '
                        </div>
                    </div>

                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">Created</div>
                        <div class="mt-1 text-gray-600 dark:text-gray-400">' . htmlspecialchars($git['createdDate']) . '</div>
                    </div>
                </div>
            </div>
        </template>
    ';
}
