<?php

// ---------------------------------------------
// Helper: Git state → border colour
// ---------------------------------------------
function gitStateBorderClass(string $state): string {
    return match ($state) {
        'clean'    => 'border-green-300',
        'dirty'    => 'border-yellow-300',
        'ahead'    => 'border-blue-300',
        'behind'   => 'border-red-300',
        'diverged' => 'border-purple-300',
        default    => 'border-gray-300', // no-repo
    };
}

// ---------------------------------------------
// Render Git Banner
// ---------------------------------------------

function renderGitBanner(array $project): string
{
    $git = $project['git'] ?? ['isRepo' => false, 'state' => 'no-repo'];

    // Map git state → Tailwind colour classes
    $bannerStyles = [
        'clean'    => ['bg' => 'bg-green-50',  'border' => 'border-green-200',  'text' => 'text-green-800',  'strong' => 'text-green-700',  'button' => 'bg-green-100 text-green-700 border-green-300 hover:bg-green-200'],
        'dirty'    => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-200', 'text' => 'text-yellow-800', 'strong' => 'text-yellow-700', 'button' => 'bg-yellow-100 text-yellow-700 border-yellow-300 hover:bg-yellow-200'],
        'ahead'    => ['bg' => 'bg-blue-50',   'border' => 'border-blue-200',   'text' => 'text-blue-800',   'strong' => 'text-blue-700',   'button' => 'bg-blue-100 text-blue-700 border-blue-300 hover:bg-blue-200'],
        'behind'   => ['bg' => 'bg-red-50',    'border' => 'border-red-200',    'text' => 'text-red-800',    'strong' => 'text-red-700',    'button' => 'bg-red-100 text-red-700 border-red-300 hover:bg-red-200'],
        'diverged' => ['bg' => 'bg-purple-50', 'border' => 'border-purple-200', 'text' => 'text-purple-800', 'strong' => 'text-purple-700', 'button' => 'bg-purple-100 text-purple-700 border-purple-300 hover:bg-purple-200'],
        'no-repo'  => ['bg' => 'bg-gray-50',   'border' => 'border-gray-200',   'text' => 'text-gray-800',   'strong' => 'text-gray-700',   'button' => ''], // no button
    ];

    $state = $git['state'] ?? 'no-repo';
    $style = $bannerStyles[$state];

    // Banner text based on state
    $stateText = match ($state) {
        'clean'    => 'Git: Clean & Up to Date',
        'dirty'    => 'Git: Uncommitted Changes',
        'ahead'    => 'Git: Ahead of Remote',
        'behind'   => 'Git: Behind Remote',
        'diverged' => 'Git: Diverged from Remote',
        default    => 'Not a Git Repository',
    };

    // Non‑repo banner (simple, no toggle)
    if ($state === 'no-repo') {
        return '
            <div class="h-12 rounded-t-md ' . $style['bg'] . ' border-b ' . $style['border'] . ' px-4 py-3 text-sm ' . $style['text'] . ' flex items-center justify-between">
                <strong class="font-semibold ' . $style['strong'] . '">' . $stateText . '</strong>
            </div>
        ';
    }

    // Repo banner with toggle button
    return '
        <div class="h-12 rounded-t-md ' . $style['bg'] . ' border-b ' . $style['border'] . ' px-4 py-3 text-sm ' . $style['text'] . ' flex items-center justify-between">
            <strong class="font-semibold ' . $style['strong'] . '">' . $stateText . '</strong>

            <button @click="gitOpen = !gitOpen"
                class="ml-4 px-3 py-1 text-xs font-medium rounded border ' . $style['button'] . ' transition"
                x-text="gitOpen ? \'Close Details\' : \'View Details\'">
            </button>
        </div>
    ';
}