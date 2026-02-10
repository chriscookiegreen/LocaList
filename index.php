<?php
    // Report *all* PHP errors, warnings, and notices to help with debugging
    error_reporting(E_ALL);

    // Display errors directly in the browser (useful in development, avoid in production)
    ini_set('display_errors', 1);

    //variables
    $directory = './';                                         // Replace with the actual directory path
    $urlGiteaServer = '#';               // Replace with your Git server URL
    $urlGithub = '#';        // Replace with your Git server URL
    $urlPHPMyadmin = '#';   // Replace with your Git server URL

    //
    // Function to create SVG icons for various technologies to be used in badges
    // Each icon is stored as a string in an associative array, keyed by the technology name
    //
    function techIcons(): array {
        return [
            // Core Web
            'HTML' => '
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" version="1.1" width="16px" height="16px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                    <g id="c133de6af664cd4f011a55de6b0011b2">
                        <path display="inline" d="M30.713,0.501L71.717,460.42l184.006,51.078l184.515-51.15L481.287,0.501H30.713z M395.754,109.646   l-2.567,28.596l-1.128,12.681h-0.187H256h-0.197h-79.599l5.155,57.761h74.444H256h115.723h15.201l-1.377,15.146l-13.255,148.506   l-0.849,9.523L256,413.854v0.012l-0.259,0.072l-115.547-32.078l-7.903-88.566h26.098h30.526l4.016,44.986l62.82,16.965l0.052-0.014   v-0.006l62.916-16.977l6.542-73.158H256h-0.197H129.771l-13.863-155.444l-1.351-15.131h141.247H256h141.104L395.754,109.646z"></path>
                    </g>
                </svg>
            ',
            'CSS' => '
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" version="1.1" width="16px" height="16px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                    <g id="c133de6af664cd4f011a55de6b001b19">
                        <path display="inline" d="M483.111,0.501l-42.59,461.314l-184.524,49.684L71.47,461.815L28.889,0.501H483.111z M397.29,94.302   H255.831H111.866l6.885,55.708h137.08h7.7l-7.7,3.205l-132.07,55.006l4.38,54.453l127.69,0.414l68.438,0.217l-4.381,72.606   l-64.058,18.035v-0.057l-0.525,0.146l-61.864-15.617l-3.754-45.07h-0.205H132.1h-0.202l7.511,87.007l116.423,34.429v-0.062   l0.21,0.062l115.799-33.802l15.021-172.761h-131.03h-0.323l0.323-0.14l135.83-58.071L397.29,94.302z"></path>
                    </g>
                </svg>
            ',
            'JavaScript' => '
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" version="1.1" width="16px" height="16px" viewBox="0 0 20 20" version="1.1">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Dribbble-Light-Preview" transform="translate(-420.000000, -7479.000000)" fill="currentColor>
                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                <path d="M379.328,7337.432 C377.583,7337.432 376.455,7336.6 375.905,7335.512 L375.905,7335.512 L377.435,7334.626 C377.838,7335.284 378.361,7335.767 379.288,7335.767 C380.066,7335.767 380.563,7335.378 380.563,7334.841 C380.563,7334.033 379.485,7333.717 378.724,7333.391 C377.368,7332.814 376.468,7332.089 376.468,7330.558 C376.468,7329.149 377.542,7328.075 379.221,7328.075 C380.415,7328.075 381.275,7328.491 381.892,7329.578 L380.429,7330.518 C380.107,7329.941 379.758,7329.713 379.221,7329.713 C378.67,7329.713 378.321,7330.062 378.321,7330.518 C378.321,7331.082 378.67,7331.31 379.476,7331.659 C381.165,7332.383 382.443,7332.952 382.443,7334.814 C382.443,7336.506 381.114,7337.432 379.328,7337.432 L379.328,7337.432 Z M375,7334.599 C375,7336.546 373.801,7337.575 372.136,7337.575 C370.632,7337.575 369.731,7337 369.288,7336 L369.273,7336 L369.266,7336 L369.262,7336 L370.791,7334.931 C371.086,7335.454 371.352,7335.825 371.996,7335.825 C372.614,7335.825 373,7335.512 373,7334.573 L373,7328 L375,7328 L375,7334.599 Z M364,7339 L384,7339 L384,7319 L364,7319 L364,7339 Z" id="javascript-[#155]"></path>
                            </g>
                        </g>
                    </g>
                </svg>
            ',
            'GIT' => '
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" version="1.1" width="16px" height="16px" viewBox="0 0 16 16">
                    <g>
                        <path d="M15,5.6,10.4,1A3.4,3.4,0,0,0,5.78.86L7.66,2.74a1.25,1.25,0,0,1,1.67,1.2V4a1.23,1.23,0,0,1-.08.38l2.45,2.4a1.17,1.17,0,0,1,.37-.08A1.3,1.3,0,1,1,10.77,8h0a1.17,1.17,0,0,1,.08-.37L8.6,5.38v5.23a1.28,1.28,0,0,1,.73,1.15,1.3,1.3,0,0,1-2.6,0,1.27,1.27,0,0,1,.67-1.11V5.07A1.27,1.27,0,0,1,6.73,4a1.17,1.17,0,0,1,.08-.37l-1.9-1.9L1,5.6a3.38,3.38,0,0,0,0,4.79H1L5.6,15a3.38,3.38,0,0,0,4.79,0h0L15,10.4a3.38,3.38,0,0,0,0-4.79Z"/>
                    </g>
                </svg>
            ',
            // PHP
            'PHP' => '
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" version="1.1" width="16px" height="16px"viewBox="0 0 24 24">
                    <path d="M12 5.5C5.27148 5.5 0 8.35547 0 12C0 15.6445 5.27148 18.5 12 18.5C18.7285 18.5 24 15.6445 24 12C24 8.35547 18.7285 5.5 12 5.5ZM10.7539 7.5H12.0645L11.6484 9.5H12.8184C13.5605 9.5 14.0586 9.60352 14.3418 9.86328C14.6191 10.1191 14.7031 10.5391 14.5918 11.1113L14.0723 13.5H12.7402L13.2188 11.291C13.2773 10.9883 13.2539 10.7773 13.1523 10.666C13.0508 10.5547 12.8281 10.5 12.4941 10.5H11.4453L10.8125 13.5H9.5L10.7539 7.5ZM5 9.5H7.66602C8.9375 9.5 9.70703 10.3516 9.40625 11.623C9.05664 13.0996 8.11914 13.5 6.39648 13.5H5.57227L5.31055 15H3.98633L5 9.5ZM15.5 9.5H18.166C19.4375 9.5 20.207 10.3516 19.9062 11.623C19.5566 13.0996 18.6191 13.5 16.8965 13.5H16.0723L15.8105 15H14.4863L15.5 9.5ZM6.13477 10.5L5.75781 12.5H6.61328C7.35352 12.5 8.04102 12.416 8.15625 11.3125C8.19922 10.8848 8.02148 10.5 7.16602 10.5H6.13477ZM16.6348 10.5L16.2578 12.5H17.1133C17.8535 12.5 18.541 12.416 18.6562 11.3125C18.6992 10.8848 18.5215 10.5 17.666 10.5H16.6348Z" fill="currentColor"/>
                </svg>
            ',
            // Node
            'Node' => '
                <svg viewBox="0 0 256 272" class="w-4 h-4">
                    <path fill="#83CD29" d="M128 0l128 74v124l-128 74L0 198V74z"/>
                </svg>
            ',
            // React
            'React' => '
                <svg viewBox="0 0 128 128" class="w-4 h-4">
                    <circle cx="64" cy="64" r="11" fill="#ffffff"/>
                    <g stroke="#ffffff" stroke-width="6" fill="none">
                        <ellipse rx="56" ry="22" cx="64" cy="64" transform="rotate(0 64 64)"/>
                        <ellipse rx="56" ry="22" cx="64" cy="64" transform="rotate(60 64 64)"/>
                        <ellipse rx="56" ry="22" cx="64" cy="64" transform="rotate(120 64 64)"/>
                    </g>
                </svg>
            ',
            // Vue
            'Vue' => '
                <svg viewBox="0 0 261.76 226.69" class="w-4 h-4">
                    <path fill="#41B883" d="M130.88 0L0 0l130.88 226.69L261.76 0z"/>
                    <path fill="#35495E" d="M130.88 0L65.44 0l65.44 113.35L196.32 0z"/>
                </svg>
            ',
            // Tailwind
            'Tailwind' => '
                <svg viewBox="0 0 128 128" class="w-4 h-4">
                    <path fill="#38BDF8" d="M64 24c-16 0-26 8-30 24 6-8 14-12 24-12 12 0 20 6 24 18 4 12 12 18 24 18 16 0 26-8 30-24-6 8-14 12-24 12-12 0-20-6-24-18-4-12-12-18-24-18z"/>
                </svg>
            ',
            // WordPress
            'WordPress' => '
                <svg viewBox="0 0 128 128" class="w-4 h-4">
                    <circle cx="64" cy="64" r="60" fill="#ffffff"/>
                    <text x="50%" y="55%" text-anchor="middle" fill="white" font-size="50" font-family="Georgia" dy=".3em">W</text>
                </svg>
            ',
            // Docker
            'Docker' => '
                <svg viewBox="0 0 256 256" class="w-4 h-4">
                    <rect x="20" y="120" width="40" height="40" fill="#ffffff"/>
                    <rect x="70" y="120" width="40" height="40" fill="#ffffff"/>
                    <rect x="120" y="120" width="40" height="40" fill="#ffffff"/>
                    <rect x="170" y="120" width="40" height="40" fill="#ffffff"/>
                    <rect x="70" y="70" width="40" height="40" fill="#ffffff"/>
                    <rect x="120" y="70" width="40" height="40" fill="#ffffff"/>
                    <rect x="170" y="70" width="40" height="40" fill="#ffffff"/>
                </svg>
            ',
        ];
    }

    //
    // Function to render badges with appropriate colours and icons which includes dark mode support
    // It takes an array of badge names (e.g., ['PHP', 'Docker']) and returns an HTML string with styled <span> elements for each badge
    //
    function renderBadges(array $badges): string {
        $icons = techIcons();

        $colors = [
            'HTML'      => 'bg-orange-500 text-white dark:bg-orange-600 dark:text-white',
            'CSS'       => 'bg-blue-500 text-white dark:bg-blue-600 dark:text-white',
            'JavaScript'=> 'bg-yellow-400 text-black dark:bg-yellow-500 dark:text-black',
            'GIT'       => 'bg-gray-700 text-white dark:bg-black',

            'PHP'       => 'bg-indigo-600 text-white dark:bg-indigo-700',
            'Composer'  => 'bg-purple-600 text-white dark:bg-purple-700',
            'Laravel'   => 'bg-red-600 text-white dark:bg-red-700',
            'Symfony'   => 'bg-gray-800 text-white dark:bg-gray-900',

            'WordPress' => 'bg-blue-600 text-white dark:bg-blue-700',
            'WooCommerce'=> 'bg-purple-700 text-white dark:bg-purple-800',

            'Node'      => 'bg-green-600 text-white dark:bg-green-700',
            'React'     => 'bg-sky-500 text-white dark:bg-sky-600',
            'Vue'       => 'bg-emerald-500 text-white dark:bg-emerald-600',
            'Svelte'    => 'bg-orange-500 text-white dark:bg-orange-600',
            'Angular'   => 'bg-red-700 text-white dark:bg-red-800',
            'Next.js'   => 'bg-black text-white dark:bg-gray-900',
            'Nuxt'      => 'bg-green-700 text-white dark:bg-green-800',

            'Vite'      => 'bg-violet-500 text-white dark:bg-violet-600',
            'Webpack'   => 'bg-blue-500 text-white dark:bg-blue-600',
            'Gulp'      => 'bg-red-500 text-white dark:bg-red-600',

            'Tailwind'  => 'bg-cyan-500 text-white dark:bg-cyan-600',
            'Bootstrap' => 'bg-purple-700 text-white dark:bg-purple-800',

            'Astro'     => 'bg-indigo-800 text-white dark:bg-indigo-900',
            'Hugo'      => 'bg-blue-700 text-white dark:bg-blue-800',
            'Jekyll'    => 'bg-red-600 text-white dark:bg-red-700',

            'Docker'    => 'bg-blue-400 text-white dark:bg-blue-500',
            'Database'  => 'bg-yellow-600 text-white dark:bg-yellow-700',
        ];

        // Start building the HTML string with a flex container
        $html = '<div class="flex flex-wrap gap-2 mt-2">';

        // Loop through each badge in the list
        foreach ($badges as $badge) {

            // Get the SVG icon for this badge, or an empty string if none exists
            $icon = $icons[$badge] ?? '';

            // Get the colour classes for this badge, or fall back to a default style
            $class = $colors[$badge] ?? 'bg-gray-300 text-black dark:bg-gray-700 dark:text-white';

            // Append a styled <span> element containing the icon and badge label
            $html .= "
                <span class='flex items-center gap-1 px-2 py-1 text-xs rounded $class'>
                    $icon
                    <span>$badge</span>
                </span>
            ";
        }

        // Close the outer container div
        $html .= '</div>';

        // Return the complete HTML string
        return $html;

    }

    //
    // Function to detect technologies used in the project by checking for specific files and dependencies
    // It takes a file path as input and returns an array of detected technologies (e.g., ['PHP', 'Docker'])
    //
    function detectTechStack(string $path): array {
        $badges = [];

        // -------------------------
        // CORE WEB
        // -------------------------
        if (glob("$path/*.html") || file_exists("$path/index.html") || file_exists("$path/index.htm")) {
            $badges[] = 'HTML';
        }

        if (glob("$path/*.css")) {
            $badges[] = 'CSS';
        }

        if (glob("$path/*.js")) {
            $badges[] = 'JavaScript';
        }

        if (is_dir("$path/.git") || file_exists("$path/HEAD")) {
            $badges[] = 'GIT';
            $GIT = true;
        } else {
            $GIT = false;
        }

        // -------------------------
        // PHP + WORDPRESS
        // -------------------------
        if (glob("$path/*.php")) {
            $badges[] = 'PHP';
        }

        if (file_exists("$path/composer.json")) {
            $badges[] = 'Composer';

            $composer = json_decode(file_get_contents("$path/composer.json"), true);
            $require = array_keys($composer['require'] ?? []);

            if (in_array('laravel/framework', $require)) $badges[] = 'Laravel';
            if (in_array('symfony/symfony', $require)) $badges[] = 'Symfony';
        }

        if (file_exists("$path/wp-config.php")) {
            $badges[] = 'WordPress';

            if (is_dir("$path/wp-content/plugins/woocommerce")) {
                $badges[] = 'WooCommerce';
            }
        }

        // -------------------------
        // NODE + FRONTEND FRAMEWORKS
        // -------------------------
        if (file_exists("$path/package.json")) {
            $badges[] = 'Node';

            $package = json_decode(file_get_contents("$path/package.json"), true);
            $deps = array_merge(
                array_keys($package['dependencies'] ?? []),
                array_keys($package['devDependencies'] ?? [])
            );

            // Frameworks
            if (in_array('react', $deps)) $badges[] = 'React';
            if (in_array('vue', $deps)) $badges[] = 'Vue';
            if (in_array('svelte', $deps)) $badges[] = 'Svelte';
            if (in_array('@angular/core', $deps)) $badges[] = 'Angular';

            // Meta-frameworks
            if (in_array('next', $deps)) $badges[] = 'Next.js';
            if (in_array('nuxt', $deps)) $badges[] = 'Nuxt';

            // Build tools
            if (in_array('vite', $deps)) $badges[] = 'Vite';
            if (in_array('webpack', $deps)) $badges[] = 'Webpack';
            if (in_array('gulp', $deps)) $badges[] = 'Gulp';

            // CSS frameworks
            if (in_array('tailwindcss', $deps)) $badges[] = 'Tailwind';
            if (in_array('bootstrap', $deps)) $badges[] = 'Bootstrap';

            // Backend
            if (in_array('express', $deps)) $badges[] = 'Express';
        }

        // -------------------------
        // STATIC SITE GENERATORS
        // -------------------------
        if (file_exists("$path/astro.config.mjs")) $badges[] = 'Astro';
        if (file_exists("$path/config.toml") && file_exists("$path/content")) $badges[] = 'Hugo';
        if (file_exists("$path/_config.yml")) $badges[] = 'Jekyll';

        // -------------------------
        // DOCKER
        // -------------------------
        if (file_exists("$path/Dockerfile") || file_exists("$path/docker-compose.yml")) {
            $badges[] = 'Docker';
        }

        // -------------------------
        // DATABASE HINT
        // -------------------------
        if (file_exists("$path/.env")) {
            $env = file_get_contents("$path/.env");
            if (strpos($env, 'DB_') !== false) {
                $badges[] = 'Database';
            }
        }

        // Return the list of badges found
        return array_unique($badges);
    }

    //
    // Function to get Git repository information such as creation date and first commit hash
function getGitInfo(string $path): array
{
    static $cache = [];
    if (isset($cache[$path])) {
        return $cache[$path];
    }

    if (!is_dir($path . '/.git')) {
        return $cache[$path] = [
            'isRepo' => false,
            'creationDate' => null,
            'formattedDate' => null,
            'hash' => null,
            'branch' => null,
            'lastCommit' => null,
            'ahead' => null,
            'behind' => null,
            'commitCount' => null,
        ];
    }

    // Helper to run Git commands
    $run = function (string $cmd) use ($path): array {
        $full = 'git -C ' . escapeshellarg($path) . ' ' . $cmd . ' 2>&1';
        $output = shell_exec($full);
        return [
            'output' => trim((string) $output),
            'success' => $output !== null && $output !== '',
        ];
    };

    // Validate repo
    $check = $run('rev-parse --is-inside-work-tree');
    if (!$check['success'] || $check['output'] !== 'true') {
        return $cache[$path] = [
            'isRepo' => false,
            'creationDate' => null,
            'formattedDate' => null,
            'hash' => null,
            'branch' => null,
            'lastCommit' => null,
            'ahead' => null,
            'behind' => null,
            'commitCount' => null,
        ];
    }

    // First commit (repo creation)
    $roots = $run('rev-list --max-parents=0 HEAD');
    $rootCommits = array_filter(explode("\n", $roots['output']));
    $firstCommit = $rootCommits[0] ?? null;

    $creationDate = null;
    $formattedDate = null;

    if ($firstCommit) {
        $date = $run('show -s --format=%ci ' . escapeshellarg($firstCommit));
        if ($date['success']) {
            $creationDate = $date['output'];
            try {
                $dt = new DateTimeImmutable($creationDate);
                $formattedDate = $dt->format('j F Y, H:i');
            } catch (Exception $e) {
                $formattedDate = null;
            }
        }
    }

    // 1. Current branch
    $branch = $run('rev-parse --abbrev-ref HEAD');
    $branchName = $branch['success'] ? $branch['output'] : null;

    // 4. Last commit info
    $lastCommitHash = $run('rev-parse HEAD')['output'] ?? null;
    $lastCommitMessage = $run('show -s --format=%s')['output'] ?? null;
    $lastCommitAuthor = $run('show -s --format=%an')['output'] ?? null;
    $lastCommitDate = $run('show -s --format=%ci')['output'] ?? null;

    $lastCommit = [
        'hash' => $lastCommitHash,
        'message' => $lastCommitMessage,
        'author' => $lastCommitAuthor,
        'date' => $lastCommitDate,
    ];

    // 6. Ahead / behind remote
    $ahead = null;
    $behind = null;

    // Only attempt if remote exists
    $remoteHead = $run('rev-parse --abbrev-ref --symbolic-full-name @{u}');
    if ($remoteHead['success']) {
        $counts = $run('rev-list --left-right --count ' . escapeshellarg($remoteHead['output']) . '...HEAD');
        if ($counts['success']) {
            [$behind, $ahead] = array_map('intval', explode("\t", $counts['output']));
        }
    }

    // 8. Total commit count
    $commitCount = $run('rev-list --count HEAD');
    $commitCountValue = $commitCount['success'] ? (int) $commitCount['output'] : null;

    return $cache[$path] = [
        'isRepo' => true,
        'creationDate' => $creationDate,
        'formattedDate' => $formattedDate,
        'hash' => $firstCommit,
        'branch' => $branchName,
        'lastCommit' => $lastCommit,
        'ahead' => $ahead,
        'behind' => $behind,
        'commitCount' => $commitCountValue,
    ];
}

?>

<!DOCTYPE html>
<html lang="en" class="h-full">
    <head>
        <meta charset="UTF-8">
        <title>LocaList Dashboard</title>
        <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/alpinejs" defer></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
            }
        </script>
    </head>

    <body class="h-full bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <div class="flex h">
            <!-- Sidebar -->
            <aside class="w-64 bg-white dark:bg-gray-800 border-r dark:border-gray-700 py-6 px-4 space-y-4">
                <nav class="space-y-2">
                    <!-- Dark Mode Button -->
                    <button id="darkToggle" class="group w-full flex items-center justify-center space-x-2 text-sm font-medium text-gray-700 dark:text-white py-2 px-2 bg-gray-100 dark:bg-gray-900 hover:bg-teal-500 dark:hover:bg-teal-500  hover:text-white rounded-md transition duration-150 ease-in-out border border-gray-300 dark:border-gray-600 rounded-md">
                        <span class="w-6 h-6 relative flex items-center justify-center">
                            <!-- Moon icon (shown in light mode) -->
                            <svg class="w-6 h-6 text-gray-700 dark:hidden dark:text-white group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                            </svg>
                            <!-- Sun icon (shown in dark mode) -->
                            <svg class="w-6 h-6 text-gray-700 hidden dark:block dark:text-white group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="5" />
                                <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42 M18.36 18.36l1.42 1.42M1 12h2M21 12h2 M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                            </svg>
                        </span>
                        <span class="dark:hidden">Dark Mode</span>
                        <span class="hidden dark:block dark:text-white">Light Mode</span>
                    </button>
         
                    <div class="h-full w-screen flex flex-row">
                        
                        <div id="sidebar" class=" h-screen md:block w-30 md:w-56 overflow-x-hidden transition-transform duration-300 ease-in-out" x-show="sidenav" @click.away="sidenav = false">
                            <div class="space-y-6 md:space-y-6 mt-6">
                                <!-- Logo -->
                                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" height="72px" width="72px" viewBox="0 0 32 32" fill="currentColor">
                                        <!-- Top right bar -->
                                        <rect x="18" y="2" width="6" height="14" rx="3" ry="3" class="text-black dark:text-white"/>
                                        <rect x="25" y="10" width="6" height="6" rx="3" ry="3" class="text-teal-600"/>

                                        <!-- Bottom right bar -->
                                        <rect x="18" y="18" width="14" height="6" rx="3" ry="3" class="text-black dark:text-white"/>
                                        <rect x="18" y="25" width="6" height="6" rx="3" ry="3" class="text-teal-600"/>

                                        <!-- Bottom left bar -->
                                        <rect x="10" y="18" width="6" height="14" rx="3" ry="3" class="text-black dark:text-white"/>
                                        <rect x="3" y="18" width="6" height="6" rx="3" ry="3" class="text-teal-600"/>

                                        <!-- Top left bar -->
                                        <rect x="2" y="10" width="14" height="6" rx="3" ry="3" class="text-black dark:text-white"/>
                                        <rect x="10" y="3" width="6" height="6" rx="3" ry="3" class="text-teal-600"/>
                                    </svg>
                                <!-- Site Name -->
                                <h1 class="font-bold text-4xl text-center md:hidden">
                                    L<span class="text-teal-600">.</span>
                                </h1>
                                <h1 class="hidden md:block font-bold text-sm md:text-4xl text-center">
                                    LocaList<span class="text-teal-600">.</span>
                                </h1>
                                <!-- Menu -->
                                <div id="menu" class="flex flex-col space-y-2">
                                    <!-- Local Network Based Resources -->
                                    <span class="text-md font-medium text-gray-700 dark:text-white pb-2 border-b border-gray-100 dark:border-gray-600">Local Resources</span>
                                    <a href="<?php echo $urlGiteaServer; ?>" target="_blank" class="group flex items-center space-x-2 text-sm font-medium text-gray-700 dark:text-white py-2 px-2 hover:bg-teal-500 hover:text-white rounded-md transition duration-150 ease-in-out">
                                        <svg class="text-gray-700 dark:text-white group-hover:text-white transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="24px" height="24px" viewBox="0 0 24 24" role="img"><path d="M4.209 4.603c-.247 0-.525.02-.84.088-.333.07-1.28.283-2.054 1.027C-.403 7.25.035 9.685.089 10.052c.065.446.263 1.687 1.21 2.768 1.749 2.141 5.513 2.092 5.513 2.092s.462 1.103 1.168 2.119c.955 1.263 1.936 2.248 2.89 2.367 2.406 0 7.212-.004 7.212-.004s.458.004 1.08-.394c.535-.324 1.013-.893 1.013-.893s.492-.527 1.18-1.73c.21-.37.385-.729.538-1.068 0 0 2.107-4.471 2.107-8.823-.042-1.318-.367-1.55-.443-1.627-.156-.156-.366-.153-.366-.153s-4.475.252-6.792.306c-.508.011-1.012.023-1.512.027v4.474l-.634-.301c0-1.39-.004-4.17-.004-4.17-1.107.016-3.405-.084-3.405-.084s-5.399-.27-5.987-.324c-.187-.011-.401-.032-.648-.032zm.354 1.832h.111s.271 2.269.6 3.597C5.549 11.147 6.22 13 6.22 13s-.996-.119-1.641-.348c-.99-.324-1.409-.714-1.409-.714s-.73-.511-1.096-1.52C1.444 8.73 2.021 7.7 2.021 7.7s.32-.859 1.47-1.145c.395-.106.863-.12 1.072-.12zm8.33 2.554c.26.003.509.127.509.127l.868.422-.529 1.075a.686.686 0 0 0-.614.359.685.685 0 0 0 .072.756l-.939 1.924a.69.69 0 0 0-.66.527.687.687 0 0 0 .347.763.686.686 0 0 0 .867-.206.688.688 0 0 0-.069-.882l.916-1.874a.667.667 0 0 0 .237-.02.657.657 0 0 0 .271-.137 8.826 8.826 0 0 1 1.016.512.761.761 0 0 1 .286.282c.073.21-.073.569-.073.569-.087.29-.702 1.55-.702 1.55a.692.692 0 0 0-.676.477.681.681 0 1 0 1.157-.252c.073-.141.141-.282.214-.431.19-.397.515-1.16.515-1.16.035-.066.218-.394.103-.814-.095-.435-.48-.638-.48-.638-.467-.301-1.116-.58-1.116-.58s0-.156-.042-.27a.688.688 0 0 0-.148-.241l.516-1.062 2.89 1.401s.48.218.583.619c.073.282-.019.534-.069.657-.24.587-2.1 4.317-2.1 4.317s-.232.554-.748.588a1.065 1.065 0 0 1-.393-.045l-.202-.08-4.31-2.1s-.417-.218-.49-.596c-.083-.31.104-.691.104-.691l2.073-4.272s.183-.37.466-.497a.855.855 0 0 1 .35-.077z"/></svg>
                                        <span class="">Gitea</span>
                                    </a>
                                    <a href="<?php echo $urlPHPMyadmin; ?>" target="_blank" class="group flex items-center space-x-2 text-sm font-medium text-gray-700 dark:text-white py-2 px-2 hover:bg-teal-500 hover:text-white rounded-md transition duration-150 ease-in-out">
                                        <svg class="text-gray-700 dark:text-white group-hover:text-white transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="24px" height="24px" viewBox="0 0 32 32" version="1.1">
                                            <path d="M20.804 22.613c-2.973 0.042-5.808 0.573-8.448 1.514l0.183-0.057c-3.584 1.22-3.688 1.685-6.936 1.303-1.718-0.263-3.265-0.75-4.698-1.436l0.1 0.043c1.696 1.366 3.785 2.312 6.071 2.65l0.069 0.008c2.444-0.149 4.708-0.785 6.741-1.812l-0.099 0.045c2.215-0.774 4.768-1.222 7.426-1.222 0.137 0 0.273 0.001 0.409 0.004l-0.020-0c3.437 0.216 6.645 0.763 9.727 1.614l-0.332-0.078c-1.791-0.855-3.889-1.593-6.074-2.107l-0.216-0.043c-1.147-0.27-2.464-0.425-3.817-0.425-0.030 0-0.060 0-0.090 0l0.005-0zM28.568 17.517l-22.394 3.81c1.127 0.399 1.921 1.455 1.921 2.697 0 0.042-0.001 0.084-0.003 0.125l0-0.006c-0.011 0.276-0.058 0.536-0.138 0.783l0.006-0.020c2.266-1.041 4.916-1.918 7.675-2.498l0.25-0.044c1.478-0.336 3.175-0.528 4.917-0.528 1.035 0 2.055 0.068 3.054 0.2l-0.117-0.013c0.908-2.119 2.635-3.741 4.772-4.489l0.057-0.017zM10.052 5.394s3.007 1.332 4.156 6.932c0.236 0.86 0.372 1.848 0.372 2.867 0 1.569-0.321 3.063-0.902 4.42l0.028-0.073c1.648-1.56 3.878-2.518 6.332-2.518 0.854 0 1.68 0.116 2.465 0.333l-0.065-0.015c-0.462-2.86-1.676-5.378-3.431-7.418l0.017 0.020c-2.128-2.674-5.334-4.411-8.95-4.548l-0.022-0.001zM7.831 5.348c1.551 2.219 2.556 4.924 2.767 7.849l0.003 0.051c0.033 0.384 0.051 0.83 0.051 1.281 0 1.893-0.326 3.71-0.926 5.397l0.035-0.113c0.906-1.076 2.215-1.788 3.692-1.902l0.018-0.001c0.062-0.005 0.124-0.008 0.185-0.010 0.083-0.603 0.13-1.3 0.13-2.008 0-2.296-0.498-4.476-1.391-6.437l0.040 0.097c-0.865-1.999-2.516-3.519-4.552-4.19l-0.053-0.015z"/>
                                        </svg>
                                        <span class="">PHPMyAdmin</span>
                                    </a>
                                    <!-- Internet Based Resources -->
                                    <span class="text-md font-medium text-gray-700 dark:text-white py-2 border-b border-gray-100 dark:border-gray-600">Resources</span>
                                    <a href="<?php echo $urlGithub; ?>" target="_blank" class="group flex items-center space-x-2 text-sm font-medium text-gray-700 dark:text-white py-2 px-2 hover:bg-teal-500 hover:text-white rounded-md transition duration-150 ease-in-out">
                                        <svg class="text-gray-700 dark:text-white group-hover:text-white transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 20 20" version="1.1">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="Dribbble-Light-Preview" transform="translate(-140.000000, -7559.000000)" fill="currentColor">
                                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                                        <path d="M94,7399 C99.523,7399 104,7403.59 104,7409.253 C104,7413.782 101.138,7417.624 97.167,7418.981 C96.66,7419.082 96.48,7418.762 96.48,7418.489 C96.48,7418.151 96.492,7417.047 96.492,7415.675 C96.492,7414.719 96.172,7414.095 95.813,7413.777 C98.04,7413.523 100.38,7412.656 100.38,7408.718 C100.38,7407.598 99.992,7406.684 99.35,7405.966 C99.454,7405.707 99.797,7404.664 99.252,7403.252 C99.252,7403.252 98.414,7402.977 96.505,7404.303 C95.706,7404.076 94.85,7403.962 94,7403.958 C93.15,7403.962 92.295,7404.076 91.497,7404.303 C89.586,7402.977 88.746,7403.252 88.746,7403.252 C88.203,7404.664 88.546,7405.707 88.649,7405.966 C88.01,7406.684 87.619,7407.598 87.619,7408.718 C87.619,7412.646 89.954,7413.526 92.175,7413.785 C91.889,7414.041 91.63,7414.493 91.54,7415.156 C90.97,7415.418 89.522,7415.871 88.63,7414.304 C88.63,7414.304 88.101,7413.319 87.097,7413.247 C87.097,7413.247 86.122,7413.234 87.029,7413.87 C87.029,7413.87 87.684,7414.185 88.139,7415.37 C88.139,7415.37 88.726,7417.2 91.508,7416.58 C91.513,7417.437 91.522,7418.245 91.522,7418.489 C91.522,7418.76 91.338,7419.077 90.839,7418.982 C86.865,7417.627 84,7413.783 84,7409.253 C84,7403.59 88.478,7399 94,7399" id="github-[#142]"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="">GitHub</span>
                                    </a>
                                    <a href="https://fontawesome.com/" target="_blank" class="group flex items-center space-x-2 text-sm font-medium text-gray-700 dark:text-white py-2 px-2 hover:bg-teal-500 hover:text-white rounded-md transition duration-150 ease-in-out">
                                        <svg class="text-gray-700 dark:text-white group-hover:text-white transition duration-150 ease-in-out"  xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="24px" height="24px" viewBox="0 0 32 32">
                                            <path d="M 9 4 C 7.346 4 6 5.346 6 7 C 6 8.3016094 6.8387486 9.4021391 8 9.8164062 L 8 11.304688 L 8 23.207031 L 8 27.023438 C 8 27.563438 8.4365625 28 8.9765625 28 L 9.0234375 28 C 9.5634375 28 10 27.563437 10 27.023438 L 10 22.228516 C 10.334707 21.839756 11.138423 21.046875 13.445312 21.046875 C 14.669313 21.046875 15.670422 21.473781 16.732422 21.925781 C 17.769422 22.367781 18.841891 22.824219 20.087891 22.824219 C 22.446891 22.824219 24.049375 21.584688 24.734375 21.054688 L 24.886719 20.939453 C 25.437719 20.540453 26 19.996 26 19 L 26 10.675781 C 26 9.7677812 25.221828 9 24.298828 9 C 23.803828 9 23.440406 9.2865937 22.941406 9.6835938 C 22.279406 10.207594 21.280891 11 20.087891 11 C 19.272891 11 18.477688 10.619734 17.554688 10.177734 C 16.403687 9.6257344 15.098359 9 13.443359 9 C 12.308257 9 11.421687 9.1883393 10.712891 9.4570312 C 11.489071 8.9141824 12 8.0167802 12 7 C 12 5.346 10.654 4 9 4 z M 9 6 C 9.552 6 10 6.449 10 7 C 10 7.551 9.552 8 9 8 C 8.448 8 8 7.551 8 7 C 8 6.449 8.448 6 9 6 z M 13.443359 11 C 14.645359 11 15.638406 11.476469 16.691406 11.980469 C 17.736406 12.482469 18.817891 13 20.087891 13 C 21.842891 13 23.158047 12.054484 23.998047 11.396484 L 23.998047 19.066406 C 23.997047 19.070406 23.952984 19.145266 23.708984 19.322266 L 23.509766 19.474609 C 22.942766 19.912609 21.762891 20.824219 20.087891 20.824219 C 19.249891 20.824219 18.446625 20.482937 17.515625 20.085938 C 16.372625 19.597938 15.076359 19.044922 13.443359 19.044922 C 11.891359 19.044922 10.786 19.358 10 19.75 L 10 12.361328 C 10.345 11.905328 11.132359 11 13.443359 11 z"/>
                                        </svg>
                                        <span class="">Font Awesome</span>
                                    </a>
                                    <a href="https://tailwindcss.com/docs" target="_blank" class="group flex items-center space-x-2 text-sm font-medium text-gray-700 dark:text-white py-2 px-2 hover:bg-teal-500 hover:text-white rounded-md transition duration-150 ease-in-out">
                                        <svg class="text-gray-700 dark:text-white group-hover:text-white transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="24px" height="24px" viewBox="0 0 24 24" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.036c-2.667 0-4.333 1.325-5 3.976 1-1.325 2.167-1.822 3.5-1.491.761.189 1.305.738 1.906 1.345C13.387 10.855 14.522 12 17 12c2.667 0 4.333-1.325 5-3.976-1 1.325-2.166 1.822-3.5 1.491-.761-.189-1.305-.738-1.907-1.345-.98-.99-2.114-2.134-4.593-2.134zM7 12c-2.667 0-4.333 1.325-5 3.976 1-1.326 2.167-1.822 3.5-1.491.761.189 1.305.738 1.907 1.345.98.989 2.115 2.134 4.594 2.134 2.667 0 4.333-1.325 5-3.976-1 1.325-2.167 1.822-3.5 1.491-.761-.189-1.305-.738-1.906-1.345C10.613 13.145 9.478 12 7 12z"/></svg>
                                        <span class="">TailwindCSS Docs</span>
                                    </a>
                                    <a href="https://www.svgrepo.com/" target="_blank" class="group flex items-center space-x-2 text-sm font-medium text-gray-700 dark:text-white py-2 px-2 hover:bg-teal-500 hover:text-white rounded-md transition duration-150 ease-in-out">
                                        <svg class="text-gray-700 dark:text-white group-hover:text-white transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="24px" height="24px" viewBox="0 0 32 32" xml:space="preserve"><defs><style>.cls-1{fill:none;}</style></defs><title>SVG</title><path d="M30,23H24a2,2,0,0,1-2-2V11a2,2,0,0,1,2-2h6v2H24V21h4V17H26V15h4Z" transform="translate(0 0)"/><polygon points="18 9 16 22 14 9 12 9 14.52 23 17.48 23 20 9 18 9"/><path d="M8,23H2V21H8V17H4a2,2,0,0,1-2-2V11A2,2,0,0,1,4,9h6v2H4v4H8a2,2,0,0,1,2,2v4A2,2,0,0,1,8,23Z" transform="translate(0 0)"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32" transform="translate(32 32) rotate(-180)"/></svg>
                                        <span class="">SVG Repo</span>
                                    </a>
                                    <a href="https://www.fontrepo.com/" target="_blank" class="group flex items-center space-x-2 text-sm font-medium text-gray-700 dark:text-white py-2 px-2 hover:bg-teal-500 hover:text-white rounded-md transition duration-150 ease-in-out">
                                        <svg class="text-gray-700 dark:text-white group-hover:text-white transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="24px" height="24px" viewBox="0 0 24 24" xml:space="preserve">
                                            <g>
                                                <path fill="none" d="M0 0h24v24H0z"/>
                                                <path d="M10 6v15H8V6H2V4h14v2h-6zm8 8v7h-2v-7h-3v-2h8v2h-3z"/>
                                            </g>
                                        </svg>
                                        <span class="">Font Repo</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    <?php
                        $entries = scandir($directory);

                        foreach ($entries as $entry) {
                            // Skip current, parent, and system volume information directories
                            if ($entry === '.' || $entry === '..' || $entry === 'System Volume Information') {
                                continue;
                            }

                            $path = $directory . $entry;
                            // Only process directories for now
                            if (!is_dir($path)) {
                                continue; 
                            }

                            // Read README.md
                            $readmePath = "{$path}/README.md";
                            $lines = file_exists($readmePath)
                                ? file($readmePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
                                : [];

                            $title = false;
                            $description = false;

                            if ($lines && count($lines) >= 2) {
                                $title = ltrim($lines[0], "# ");
                                $description = $lines[1];
                            }

                            // Git info
                            $info = getGitInfo($path);

                            // Preview image detection
                            $extensions = ['jpg', 'jpeg', 'png', 'webp'];
                            $preview = null;

                            foreach ($extensions as $ext) {
                                $candidate = "{$path}/preview.$ext";
                                if (file_exists($candidate)) {
                                    $preview = $candidate;
                                    break;
                                }
                            }

                            if ($preview) {
                                // Show the actual preview image
                                $previewOutput = '<img src="' . $preview . '" alt="' . $title . '" class="h-60 mx-auto pb-4 object-contain" />';
                            } else {
                                // Show ONLY the yellow banner, centered in the h-60 space
                                $previewOutput = '
                                    <div class="h-60 flex items-center justify-center px-4 pb-4">
                                        <div class="rounded-md bg-yellow-50 border border-yellow-200 px-4 py-4 text-sm text-yellow-800 text-center flex flex-col items-center gap-3">

                                            <!-- Small SVG icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                class="h-10 w-10 text-yellow-700 opacity-80" 
                                                fill="currentColor" viewBox="0 0 32 32">
                                                <defs><style>.cls-1{fill:none;}</style></defs>
                                                <title>no-image</title>
                                                <path d="M30,3.4141,28.5859,2,2,28.5859,3.4141,30l2-2H26a2.0027,2.0027,0,0,0,2-2V5.4141ZM26,26H7.4141l7.7929-7.793,2.3788,2.3787a2,2,0,0,0,2.8284,0L22,19l4,3.9973Zm0-5.8318-2.5858-2.5859a2,2,0,0,0-2.8284,0L19,19.1682l-2.377-2.3771L26,7.4141Z"/>
                                                <path d="M6,22V19l5-4.9966,1.3733,1.3733,1.4159-1.416-1.375-1.375a2,2,0,0,0-2.8284,0L6,16.1716V6H22V4H6A2.002,2.002,0,0,0,4,6V22Z"/>
                                                <rect class="cls-1" width="32" height="32"/>
                                            </svg>

                                            <!-- Banner text -->
                                            <div>
                                                <strong>This project has no preview.</strong><br>
                                                Please update your project to include one.
                                            </div>

                                        </div>
                                    </div>
                                ';
                            }
                        ?>

                        <!-- CARD START -->
                        <div x-data="{gitOpen: false, descOpen: false, actionsOpen: false, showReadMore: false, checkOverflow(el) { this.showReadMore = el.scrollHeight > el.clientHeight } }" class="flex flex-col border border-solid dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden relative">

                            <!-- GIT BANNER -->
                            <?php if ($info['isRepo']): ?>
                                <div class="rounded-md bg-green-50 border border-green-200 m-4 px-4 py-3 text-sm text-green-800 flex items-center justify-between">
                                    <div class="font-semibold text-green-700">Git Repository Detected</div>
                                    <button @click="gitOpen = !gitOpen; descOpen = false" class="ml-4 px-3 py-1 text-xs font-medium rounded bg-green-100 text-green-700 border border-green-300 hover:bg-green-200 transition" x-text="gitOpen ? 'Close GIT Details' : 'View GIT Details'" ></button>
                                </div>
                            <?php else: ?>
                                <div class="rounded-md bg-red-50 border border-red-200 m-4 px-4 py-3 text-sm text-red-800">
                                    <span class="font-semibold text-red-700">Not a Git Repository.</span>
                                    <span class="text-red-700">Please consider making one to enable version control.</span>
                                </div>
                            <?php endif; ?>

                            <!-- SHARED OVERLAY (Git + Description + Actions) -->
                            <div x-show="gitOpen || descOpen || actionsOpen" x-transition @click.outside="gitOpen = false; descOpen = false; actionsOpen = false" class="absolute left-4 right-4 top-[4.5rem] z-50 rounded-lg border border-gray-200 bg-white dark:bg-gray-800 shadow-xl" >
                                <!-- GIT DETAILS -->
                                <template x-if="gitOpen">
                                    <div>
                                        <div class="px-4 py-3 border-b border-gray-100">
                                            <h3 class="text-sm font-semibold text-gray-700"><?= htmlspecialchars($title) ?> Repository Details</h3>
                                        </div>

                                        <div class="px-4 py-4 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
                                            <div>
                                                <div class="font-medium text-gray-900">Current Branch</div>
                                                <div class="mt-1 text-gray-600"><?= htmlspecialchars($info['branch']) ?></div>
                                            </div>

                                            <div>
                                                <div class="font-medium text-gray-900">Total Commits</div>
                                                <div class="mt-1 text-gray-600"><?= htmlspecialchars($info['commitCount']) ?></div>
                                            </div>

                                            <div class="md:col-span-2">
                                                <div class="font-medium text-gray-900">Last Commit</div>
                                                <div class="mt-1 text-gray-600 space-y-1">
                                                    <div><span class="font-semibold">Hash:</span> <?= htmlspecialchars($info['lastCommit']['hash']) ?></div>
                                                    <div><span class="font-semibold">Message:</span> <?= htmlspecialchars($info['lastCommit']['message']) ?></div>
                                                    <div><span class="font-semibold">Author:</span> <?= htmlspecialchars($info['lastCommit']['author']) ?></div>
                                                    <div><span class="font-semibold">Date:</span> <?= htmlspecialchars($info['lastCommit']['date']) ?></div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="font-medium text-gray-900">Sync Status</div>
                                                <div class="mt-1 text-gray-600 flex items-center gap-2">
                                                    <span class="px-2 py-1 rounded bg-blue-50 text-blue-700 border border-blue-200">
                                                        ↑ <?= intval($info['ahead']) ?> ahead
                                                    </span>
                                                    <span class="px-2 py-1 rounded bg-yellow-50 text-yellow-700 border border-yellow-200">
                                                        ↓ <?= intval($info['behind']) ?> behind
                                                    </span>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="font-medium text-gray-900">Repository Created</div>
                                                <div class="mt-1 text-gray-600"><?= htmlspecialchars($info['formattedDate']) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <!-- FULL DESCRIPTION -->
                                <template x-if="descOpen">
                                    <div>
                                        <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                                            <h3 class="text-sm font-semibold text-gray-700"><?= htmlspecialchars($title) ?> Description</h3>
                                            <button @click="descOpen = false" class="text-gray-500 hover:text-gray-700">✕</button>
                                        </div>

                                        <div class="px-4 py-4 text-sm text-gray-700 dark:text-gray-200 max-h-64 overflow-y-auto">
                                            <?= nl2br(htmlspecialchars($description)) ?>
                                        </div>
                                    </div>
                                </template>
                                <!-- Actions -->
                                <template x-if="actionsOpen">
                                    <div>
                                        <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                                            <h3 class="text-sm font-semibold text-gray-700">Project Actions</h3>
                                            <button @click="actionsOpen = false" class="text-gray-500 hover:text-gray-700">✕</button>
                                        </div>

                                        <div class="px-4 py-4 flex flex-col gap-3 text-sm text-gray-700 dark:text-gray-200">

                                            <!-- Gitea -->
                                            <a href="<?= $urlGiteaServer . $entry ?>" target="_blank"
                                            class="flex items-center gap-2 px-3 py-2 rounded-md border dark:border-gray-600 bg-gray-50 dark:bg-gray-700 
                                                    hover:bg-teal-500 hover:text-white transition">
                                                <span>Open in Gitea</span>
                                            </a>

                                            <!-- GitHub -->
                                            <a href="<?= $urlGithub . $entry ?>" target="_blank"
                                            class="flex items-center gap-2 px-3 py-2 rounded-md border dark:border-gray-600 bg-gray-50 dark:bg-gray-700 
                                                    hover:bg-teal-500 hover:text-white transition">
                                                <span>Open in GitHub</span>
                                            </a>

                                            <!-- VS Code -->
                                            <a href="vscode://file/W:/<?= urlencode($path) ?>"
                                            class="flex items-center gap-2 px-3 py-2 rounded-md border dark:border-gray-600 bg-gray-50 dark:bg-gray-700 
                                                    hover:bg-teal-500 hover:text-white transition">
                                                <span>Open in VS Code</span>
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- TITLE -->
                            <div class="px-4 pb-4 mt-auto">
                                <?php if ($title): ?>
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        <?= htmlspecialchars($title) ?>
                                    </h2>
                                <?php else: ?>
                                    <div class="rounded-md bg-yellow-50 border border-yellow-200 px-4 py-3 text-sm text-yellow-800">
                                        <strong>This project has no title.</strong> Please add a title to your README.md file.
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- PREVIEW IMAGE -->
                            <?= $previewOutput ?>


                            <!-- DESCRIPTION AREA -->
                            <div class="px-4 pb-4 flex flex-col justify-between flex-1">

                                <div class="relative mb-4" x-init="checkOverflow($refs.desc)">
                                    <div x-ref="desc" class="relative h-16 overflow-hidden text-sm text-gray-500 sm:text-base dark:text-gray-300" >
                                        <?php if ($description): ?>
                                            <div class="pr-2">
                                                <?= nl2br(htmlspecialchars($description)) ?>
                                                <div class="absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-b from-transparent to-white dark:to-gray-800 pointer-events-none"></div>
                                            </div>
                                        <?php else: ?>
                                            <div class="rounded-md bg-yellow-50 border border-yellow-200 px-4 py-3 text-sm text-yellow-800">
                                                <strong>This project has no description.</strong> Please add one to your README.md file.
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <button x-show="showReadMore" @click="descOpen = !descOpen; gitOpen = false" class="absolute bottom-1 left-1/2 -translate-x-1/2 px-3 py-3 text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-sm font-semibold hover:bg-teal-500 dark:hover:bg-teal-500 hover:text-white rounded-md transition duration-150 ease-in-out" x-text="descOpen ? 'Close Description' : 'Read Description'"></button>
                                </div>

                                <!-- FULL-WIDTH ACTIONS BUTTON -->
                                <div >
                                    <button @click="actionsOpen = !actionsOpen; gitOpen = false; descOpen = false" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-sm font-semibold hover:bg-teal-500 dark:hover:bg-teal-500 hover:text-white rounded-md transition duration-150 ease-in-out" x-text="actionsOpen ? 'Close Project Actions' : 'Project Actions'" ></button>
                                </div>

                                <div class="flex flex-wrap items-center">
                                    <span class="text-xs pr-4">Built Using:</span>
                                    <?= renderBadges(detectTechStack($path)) ?>
                                </div>
                            </div>
                        </div>

                    <?php
                        } // end foreach
                    ?>
                </div>
            </main>
        </div>

        <!-- Footer  -->
         <footer class="bg-zinc-700">
            <div class="container mx-auto p-0 md:p-8 xl:px-0">
                <div class="mx-auto max-w-7xl px-6 pb-10 pt-16">
                    <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                        <!-- Column 01 -->
                        <div class="space-y-4">
                            <div>
                                <div class="flex items-center space-x-2 text-2xl font-medium">
                                    <!-- Logo -->
                                    <span>
                                        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" height="48px" width="48px" viewBox="0 0 32 32" fill="currentColor">
                                            <!-- Top right bar -->
                                            <rect x="18" y="2" width="6" height="14" rx="3" ry="3" />
                                            <rect x="25" y="10" width="6" height="6" rx="3" ry="3" class="text-teal-600"/>

                                            <!-- Bottom right bar -->
                                            <rect x="18" y="18" width="14" height="6" rx="3" ry="3" />
                                            <rect x="18" y="25" width="6" height="6" rx="3" ry="3" class="text-teal-600"/>

                                            <!-- Bottom left bar -->
                                            <rect x="10" y="18" width="6" height="14" rx="3" ry="3" />
                                            <rect x="3" y="18" width="6" height="6" rx="3" ry="3" class="text-teal-600"/>

                                            <!-- Top left bar -->
                                            <rect x="2" y="10" width="14" height="6" rx="3" ry="3" />
                                            <rect x="10" y="3" width="6" height="6" rx="3" ry="3" class="text-teal-600"/>
                                        </svg>
                                    </span>
                                    <!-- Site Name -->
                                    <h1 class="font-bold text-4xl text-center text-white md:hidden">
                                        L<span class="text-teal-600">.</span>
                                    </h1>
                                    <h1 class="hidden md:block font-bold text-sm md:text-4xl text-center text-white">
                                        LocaList<span class="text-teal-600">.</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Site Description -->
                            <div class="max-w-md pr-16 text-md text-gray-200">Enhance productivity and
                                efficiency with cutting-edge artificial intelligence solutions for your business operations.
                            </div>
                            <!-- LSocial Links -->
                            <div class="flex space-x-2">
                                <a href="" target="_blank" class="text-gray-200 hover:text-gray-200">
                                    <span class="sr-only">Linkedin</span><svg fill="currentColor" viewBox="0 0 24 24"
                                        class="h-6 w-6" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="" target="_blank" class="text-gray-200 hover:text-gray-200">
                                    <span class="sr-only">Twitter</span><svg fill="currentColor" viewBox="0 0 24 24"
                                        class="h-6 w-6" aria-hidden="true">
                                        <path
                                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                            <!-- Footer Menu 01 -->
                            <div class="md:grid md:grid-cols-2 md:gap-8">
                                <div>
                                    <h3 class="text-md font-semibold leading-6 text-white">Our Solutions</h3>
                                    <ul role="list" class="mt-6 space-y-4">
                                        <li>
                                            <a href="/aiplatform"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">AI Platform
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/aialgorithms"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">AI Algorithms
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/industryapplications"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">Industry
                                                Applications
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                
                                <!-- Footer Menu 02 -->
                                <div class="mt-10 md:mt-0">
                                    <h3 class="text-md font-semibold leading-6 text-white">Use Cases</h3>
                                    <ul role="list" class="mt-6 space-y-4">
                                        <li>
                                            <a href="/predictiveanalysis"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">Predictive
                                                Analysis
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/customerexperience"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">Customer
                                                Experience
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/automation"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">Automation
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="md:grid md:grid-cols-2 md:gap-8">
                                
                                <!-- Footer Menu 03 -->
                                <div>
                                    <h3 class="text-md font-semibold leading-6 text-white">Resources</h3>
                                    <ul role="list" class="mt-6 space-y-4">
                                        <li>
                                            <a href="/pricing"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">Pricing
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/blog" class="text-md leading-6 text-gray-300 hover:text-gray-50">Blog
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/casestudies"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">Case Studies
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/terms" class="text-md leading-6 text-gray-300 hover:text-gray-50">Terms
                                                of Service
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/privacy"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">Privacy Policy
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Footer Menu 04 -->
                                <div class="mt-10 md:mt-0">
                                    <h3 class="text-md font-semibold leading-6 text-white">Company</h3>
                                    <ul role="list" class="mt-6 space-y-4">
                                        <li>
                                            <a href="/aboutus"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">About Us
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/careers"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">Careers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/contactus"
                                                class="text-md leading-6 text-gray-300 hover:text-gray-50">Contact Us
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="mt-16 border-t border-gray-400/30 pt-8 sm:mt-20 lg:mt-24">
                        <div class="text-md text-center text-white">
                            Copyright © 2024 . Crafted with
                            <span class="text-gray-50">♥</span> by AI enthusiasts at
                            <a rel="noopener" href="/">AIOps.
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- TailwindCSS Dark Mode Script -->
        <script>
            const toggle = document.getElementById('darkToggle');
            toggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            });
        </script>

    </body>
</html>
