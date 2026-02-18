<?php

function renderPreview(array $project): string {
    if ($project['preview']) {
        return '<a href="' . $project['path'] . '" target="_blank">
            <img src="' . $project['preview'] . '" class="h-60 mx-auto pb-4 object-contain" />
            </a>';
    }

    return '
        <a href="' . $project['path'] . '" target="_blank">
            <div class="h-60 flex items-center justify-center px-4 pb-4">
                <div class="h-12 rounded-md bg-yellow-50 border border-yellow-200 mt-1 px-4 py-3 text-sm text-yellow-800 flex items-center justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-700 opacity-80" fill="currentColor" viewBox="0 0 32 32">
                        <path d="M30,3.4141...Z"/>
                    </svg>
                    <div>
                        <strong>This project has no preview.</strong><br>
                        Please update your project to include one.
                    </div>
                </div>
            </div>
        </a>
    ';
}