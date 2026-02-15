<?php

function renderGitBanner(array $project): string {
    if ($project['git']['isRepo']) {
        return '
        <div class="h-12 rounded-md bg-green-50 border border-green-200 m-4 px-4 py-3 text-sm text-green-800 flex items-center justify-between">
            <strong class="font-semibold text-green-700">Git Repository</strong>
            <button @click="gitOpen = !gitOpen"
                class="ml-4 px-3 py-1 text-xs font-medium rounded bg-green-100 text-green-700 border border-green-300 hover:bg-green-200 transition"
                x-text="gitOpen ? \'Close Details\' : \'View Details\'">
        </button>

        </div>
        ';
    }

    return '
        <div class="h-12 rounded-md bg-red-50 border border-red-200 m-4 px-4 py-3 text-sm text-red-800 flex items-center justify-between">
            <strong class="font-semibold text-red-700">Not a Git Repository</strong>
        </div>
    ';
}

