<?php
    // ------------------------------------------------------------
    // Report *all* PHP errors, warnings, and notices to help with debugging
    // ------------------------------------------------------------
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // ------------------------------------------------------------
    // Load core functions
    // ------------------------------------------------------------
    require_once __DIR__ . '/includes/data/readme.php';
    require_once __DIR__ . '/includes/data/preview.php';
    require_once __DIR__ . '/includes/data/tech.php';
    require_once __DIR__ . '/includes/data/project-info.php';

    require_once __DIR__ . '/includes/render/title.php';
    require_once __DIR__ . '/includes/render/preview.php';
    require_once __DIR__ . '/includes/render/description.php';
    require_once __DIR__ . '/includes/render/description-overlay.php';
    require_once __DIR__ . '/includes/render/actions-overlay.php';
    require_once __DIR__ . '/includes/render/tech-badges.php';
    require_once __DIR__ . '/includes/render/card.php';
    require_once __DIR__ . '/includes/render/all-cards.php';

    // ------------------------------------------------------------
    // Configuration
    // ------------------------------------------------------------
    $directory      = '../';
    $urlGiteaServer = 'http://192.168.1.227:3000/chrisgreen/';
    $urlGithub      = 'https://github.com/chriscookiegreen/';
    $urlPHPMyadmin  = 'http://192.168.1.151/phpmyadmin/';

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

    <body class="h-full min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <div class="flex h">
            <!-- Sidebar -->
            <aside class="w-64 fixed top-0 left-0 overflow-y-auto bg-white dark:bg-gray-800 border-r dark:border-gray-700 py-6 px-4 space-y-4">
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
                                <svg class="text-white mx-auto" xmlns="http://www.w3.org/2000/svg" height="72px" width="72px" viewBox="0 0 32 32" fill="currentColor">
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
                                    <span class="text-md font-medium text-gray-700 dark:text-white pb-2 border-b border-gray-100 dark:border-gray-600">Sort</span>
                                    <div class="w-full">
                                        <select id="sort"
                                            class="w-full text-sm font-medium text-gray-700 dark:text-white py-2 px-2 bg-gray-100 dark:bg-gray-900 rounded-md transition duration-150 ease-in-out border border-gray-300 dark:border-gray-600"
                                            onchange="applySort(this.value)">
                                            <option value="name_asc">Name (A–Z)</option>
                                            <option value="name_desc">Name (Z–A)</option>
                                            <option value="modified">Last Modified</option>
                                            <option value="created">Created</option>
                                        </select>
                                    </div>

                                    <!-- Local Network Based Resources -->
                                    <span class="text-md font-medium text-gray-700 dark:text-white py-2 border-b border-gray-100 dark:border-gray-600">Local Resources</span>
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
            <main class="flex-1 ml-64 p-6 overflow-y-auto">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    <?php echo renderAllProjectCards($directory) ?>
                </div>
            </main>
        </div>

        <!-- Footer  -->
         <footer class="mt-auto bg-zinc-700">
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
                            <!-- Social Links -->
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

        
        <script>
            // TailwindCSS Dark Mode Script
            const toggle = document.getElementById('darkToggle');
            toggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            });
            // Project Sorting Script
            function applySort(mode) {
                localStorage.setItem('loca_sort', mode);
                const url = new URL(window.location.href);
                url.searchParams.set('sort', mode);
                window.location.href = url.toString();
            }

            // On load, restore the dropdown state
            document.addEventListener('DOMContentLoaded', () => {
                const saved = localStorage.getItem('loca_sort');
                if (saved) {
                    document.getElementById('sort').value = saved;
                }
            });

        </script>

    </body>
</html>
