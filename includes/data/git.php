<?php

function isGitRepo(string $path): bool {
    // First check for .git folder
    if (!is_dir($path . '/.git')) {
        return false;
    }

    // Then ask Git directly
    $check = trim((string) shell_exec(
        "cd " . escapeshellarg($path) . " && git rev-parse --is-inside-work-tree 2>&1"
    ));

    return $check === 'true';
}


function runGit(string $path, string $command): string {
    $output = trim((string) shell_exec("cd " . escapeshellarg($path) . " && $command 2>&1"));

    if (
        str_contains($output, 'fatal: not a git repository') ||
        str_contains($output, 'fatal: detected dubious ownership') ||
        str_contains($output, 'fatal:')
    ) {
        return '__GIT_ERROR__';
    }

    return $output;
}

function getGitDetails(string $path): array {
    if (!isGitRepo($path)) {
        return [
            'isRepo' => false,
            'state'  => 'no-repo'
        ];
    }

    // Repo creation date (first commit)
    $createdDateRaw = runGit($path, "git log --pretty=%ad --date=short --reverse | head -1");
    $createdDate = date('d-m-Y', strtotime($createdDateRaw));

    // Branch
    $branch = runGit($path, "git rev-parse --abbrev-ref HEAD");
    if ($branch === '__GIT_ERROR__') {
        return ['isRepo' => false, 'state' => 'no-repo'];
    }

    // Status (uncommitted changes)
    $status = runGit($path, "git status --short");
    if ($status === '__GIT_ERROR__') {
        return ['isRepo' => false, 'state' => 'no-repo'];
    }

    // Ahead/behind
    $aheadBehind = runGit($path, "git rev-list --left-right --count @{u}...HEAD");
    if ($aheadBehind === '__GIT_ERROR__') {
        return ['isRepo' => false, 'state' => 'no-repo'];
    }

    [$behind, $ahead] = array_pad(explode("\t", $aheadBehind), 2, 0);

    // Total commits
    $totalCommits = runGit($path, "git rev-list --count HEAD");

    // Last commit info
    $lastMsg  = runGit($path, "git log -1 --pretty=%s");
    $lastAuth = runGit($path, "git log -1 --pretty=%an");
    $lastDateRaw = runGit($path, "git log -1 --pretty=%ad --date=short");
    $lastDate = date('d-m-Y', strtotime($lastDateRaw));

    if ($lastMsg === '__GIT_ERROR__') {
        return ['isRepo' => false, 'state' => 'no-repo'];
    }

    // ---------------------------------------------------------
    // GIT STATE CLASSIFICATION
    // ---------------------------------------------------------

    $state = 'clean'; // default

    if (trim($status) !== '') {
        $state = 'dirty';
    } elseif ($ahead > 0 && $behind > 0) {
        $state = 'diverged';
    } elseif ($ahead > 0) {
        $state = 'ahead';
    } elseif ($behind > 0) {
        $state = 'behind';
    }

    // ---------------------------------------------------------



    return [
        'isRepo'       => true,
        'state'        => $state,
        'createdDate'  => $createdDate,
        'branch'       => $branch,
        'status'       => $status,
        'ahead'        => (int) $ahead,
        'behind'       => (int) $behind,
        'totalCommits' => (int) $totalCommits,
        'lastMsg'      => $lastMsg,
        'lastAuth'     => $lastAuth,
        'lastDate'     => $lastDate,
        'remote'       => runGit($path, "git remote get-url origin"),
    ];
}