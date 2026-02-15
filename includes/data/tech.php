<?php

require_once __DIR__ . '/../../index.php'; // for detectTechStack + renderBadges

function getProjectTechStack(string $path): array {
    return detectTechStack($path);
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