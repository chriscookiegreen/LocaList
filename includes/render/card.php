<?php

require_once __DIR__ . '/title.php';
require_once __DIR__ . '/preview.php';
require_once __DIR__ . '/description.php';
require_once __DIR__ . '/description-overlay.php';
require_once __DIR__ . '/actions-overlay.php';
require_once __DIR__ . '/git-overlay.php';
require_once __DIR__ . '/tech-badges.php';
require_once __DIR__ . '/git-banner.php';

function renderProjectCard(array $project, string $urlGiteaServer, string $urlGithub): string {
$desc = $project['description'] ?? '';
$shouldShowReadMore = strlen($desc) > 160;
$remote = addslashes($project['git']['remote'] ?? '');

$state = $project['git']['state'] ?? 'no-repo';
$borderClass = gitStateBorderClass($state);

return '
<div x-data="{
    descOpen: false,
    actionsOpen: false,
    gitOpen: false,
    showReadMore: ' . ($shouldShowReadMore ? 'true' : 'false') . ',
    copiedRemote: false,
    copyRemote() {
        const remote = \'' . $remote . '\';
        if (!remote) return;
        navigator.clipboard.writeText(remote).then(() => {
            this.copiedRemote = true;
            setTimeout(() => { this.copiedRemote = false }, 1500);
        });
    }
}"



class="flex flex-col border ' . $borderClass . ' bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden relative">

            <div x-show="descOpen || actionsOpen || gitOpen"
                 @click.outside="descOpen = false; actionsOpen = false; gitOpen = false"
                 class="absolute left-4 right-4 top-[4.5rem] z-50 rounded-lg border bg-white dark:bg-gray-800 shadow-xl">

                ' . renderDescriptionOverlay($project) . '
                ' . renderActionsOverlay($project, $urlGiteaServer, $urlGithub) . '
                ' . renderGitOverlay($project) . '

            </div>

            ' . renderGitBanner($project) . '

            <div class="px-4 pb-4">
                <div class="h-10 flex items-center">
                    ' . renderTitle($project) . '
                </div>

                ' . renderPreview($project) . '

                ' . renderDescriptionBlock($project) . '

                <button @click="actionsOpen = !actionsOpen"
                        class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-sm font-semibold hover:bg-teal-500 hover:text-white rounded-md transition">
                    Project Actions
                </button>

                <div class="hidden">
                ' . renderTechBadgesBlock($project) . '
                </div>
            </div>
        </div>
    ';
}