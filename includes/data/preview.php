<?php

function getProjectPreview(string $path): ?string {
    $extensions = ['jpg', 'jpeg', 'png', 'webp'];

    foreach ($extensions as $ext) {
        $candidate = "{$path}/preview.$ext";
        if (file_exists($candidate)) {
            return $candidate;
        }
    }

    return null;
}