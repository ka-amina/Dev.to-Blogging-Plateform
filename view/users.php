<?php
require_once '../app/config/connexion.php';
require '../vendor/autoload.php';

session_start();

use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\userController;

$articlesList = new ArticleController();
$categoryList = new CategoryController();
$users= new userController();

$user=$users->showUsers();

$articles = $articlesList->listArticles();
$categories = $categoryList->listCategories();
if (isset($_GET['action']) && $_GET['action'] == 'create') {
    $users->createUser($_POST);
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $users->deleteUser($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <!-- dir="rtl" for RTL support -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>Taildashboards Project</title>

    <!-- Inter web font from bunny.net (GDPR compliant) -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
        href="https://fonts.bunny.net/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS Play CDN (mainly for development/testing purposes) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>

    <!-- Tailwind CSS v3 Configuration -->
    <script>
        const defaultTheme = tailwind.defaultTheme;
        const colors = tailwind.colors;
        const plugin = tailwind.plugin;

        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", ...defaultTheme.fontFamily.sans],
                    },
                },
            },
        };
    </script>

    <!-- Alpine Core -->
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine x-cloak style (https://alpinejs.dev/directives/cloak) -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>

<body>
    <div
        x-data="{ darkMode: false, mobileSidebarOpen: false, activeTab: 'Analytics' }"
        x-bind:class="{ 'dark': darkMode }">
        <!-- Page Container -->
        <div
            id="page-container"
            class="relative mx-auto flex min-h-screen   bg-white dark:bg-slate-900 dark:text-slate-100 lg:ms-16">
            <!-- Page Sidebar -->
            <nav
                id="page-sidebar"
                class="fixed bottom-0 start-0 top-0 z-50 flex h-full  border-slate-200/75 bg-white transition-transform duration-500 ease-out dark:border-slate-700/60 dark:bg-slate-900  lg:translate-x-0 lg:shadow-none ltr:border-r ltr:lg:translate-x-0 rtl:border-l rtl:lg:translate-x-0"
                x-bind:class="{
              'ltr:-translate-x-full rtl:translate-x-full': !mobileSidebarOpen,
             'translate-x-0 shadow-lg': mobileSidebarOpen,
              }"
                aria-label="Main Sidebar Navigation"
                x-cloak>
                <!-- Mini Sidebar -->
                <div
                    class="w-16 flex-none border-slate-200/75 bg-slate-50 dark:border-slate-700/60 dark:bg-slate-900/75 ltr:border-r rtl:border-l">
                    <!-- Brand -->
                    <a
                        href="javascript:void(0)"
                        class="group flex h-16 items-center justify-center border-b border-slate-200/50 text-slate-500 hover:bg-slate-100 active:bg-slate-50 dark:border-slate-700/60 dark:hover:bg-slate-800 dark:hover:text-slate-400 dark:active:bg-slate-800/50">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 49 48"
                            fill="currentColor"
                            class="w-6 -rotate-6 transition group-active:rotate-0">
                            <path
                                d="M24.5 12.75C24.5 18.963 19.463 24 13.25 24H2V12.75C2 6.537 7.037 1.5 13.25 1.5S24.5 6.537 24.5 12.75ZM24.5 35.25C24.5 29.037 29.537 24 35.75 24H47v11.25c0 6.213-5.037 11.25-11.25 11.25S24.5 41.463 24.5 35.25ZM2 35.25C2 41.463 7.037 46.5 13.25 46.5H24.5V35.25C24.5 29.037 19.463 24 13.25 24S2 29.037 2 35.25ZM47 12.75C47 6.537 41.963 1.5 35.75 1.5H24.5v11.25C24.5 18.963 29.537 24 35.75 24S47 18.963 47 12.75Z" />
                        </svg>
                    </a>
                    <!-- END Brand -->

                    <!-- App Navigation -->
                    <nav
                        class="relative flex flex-col items-center gap-3 py-6"
                        x-on:keydown.right.prevent.stop="$focus.wrap().next()"
                        x-on:keydown.left.prevent.stop="$focus.wrap().previous()"
                        x-on:keydown.down.prevent.stop="$focus.wrap().next()"
                        x-on:keydown.up.prevent.stop="$focus.wrap().previous()"
                        x-on:keydown.home.prevent.stop="$focus.first()"
                        x-on:keydown.end.prevent.stop="$focus.last()">
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                        <button
                            id="analytics-tab"
                            role="tab"
                            aria-controls="analytics-tab-pane"
                            type="button"
                            class="flex size-9 items-center justify-center rounded-xl bg-rose-700 text-white hover:bg-rose-600 active:bg-rose-700">
                            <a href="dashboard.php">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16"
                                    fill="currentColor"
                                    class="hi-micro hi-chart-bar inline-block size-4">
                                    <path
                                        d="M12 2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-1ZM6.5 6a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V6ZM2 9a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V9Z" />
                                </svg>
                            </a>
                           </button>

                           <button
                              x-on:focus="activeTab = 'article'"
                              x-on:click="activeTab = 'article'"
                               id="article-tab"
                               role="tab"
                               aria-controls="article-tab-pane"
                               x-bind:aria-selected="activeTab === 'article' ? 'true' : 'false'"
                               x-bind:tabindex="activeTab === 'article' ? '0' : '-1'"
                               type="button"
                               class="flex size-9 items-center justify-center rounded-xl bg-indigo-800 text-white hover:bg-indigo-700 active:bg-indigo-800"
                               x-bind:class="{
                             'ring-4 ring-indigo-400/50 dark:ring-indigo-600/50': activeTab === 'article'
                              }">
                              <a href="articles.php">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z" />
                              </svg>
                              </a>
                           </button>

                           <button
                                x-on:click="activeTab = 'tags'"
                                x-on:focus="activeTab = 'tags'"
                                id="tags-tab"
                                role="tab"
                                aria-controls="tags-tab-pane"
                                x-bind:aria-selected="activeTab === 'tags' ? 'true' : 'false'"
                                x-bind:tabindex="activeTab === 'tags' ? '0' : '-1'"
                                type="button"
                                class="flex size-9 items-center justify-center rounded-xl bg-indigo-800 text-white hover:bg-indigo-700 active:bg-indigo-800"
                                x-bind:class="{
                               'ring-4 ring-indigo-400/50 dark:ring-indigo-600/50': activeTab === 'tags'
                                 }">
                                <a href="tags.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M0 80L0 229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7L48 32C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                    </svg>
                                </a>
                            </button>

                            <button
                                x-on:click="activeTab = 'categories'"
                                x-on:focus="activeTab = 'categories'"
                                id="categories-tab"
                                role="tab"
                                aria-controls="categories-tab-pane"
                                x-bind:aria-selected="activeTab === 'categories' ? 'true' : 'false'"
                                x-bind:tabindex="activeTab === 'categories' ? '0' : '-1'"
                                type="button"
                                class="flex size-9 items-center justify-center rounded-xl bg-indigo-800 text-white hover:bg-indigo-700 active:bg-indigo-800"
                                x-bind:class="{
                               'ring-4 ring-indigo-400/50 dark:ring-indigo-600/50': activeTab === 'categories'
                              }">
                                <a href="categories.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z" />
                                    </svg>
                                </a>
                            </button>

                            <button
                                x-on:click="activeTab = 'users'"
                                x-on:focus="activeTab = 'users'"
                                id="settings-tab"
                                role="tab"
                                aria-controls="settings-tab-pane"
                                x-bind:aria-selected="activeTab === 'Settings' ? 'true' : 'false'"
                                x-bind:tabindex="activeTab === 'Settings' ? '0' : '-1'"
                                type="button"
                                class="flex size-9 items-center justify-center rounded-xl bg-slate-700 text-white hover:bg-slate-600 active:bg-slate-700"
                                x-bind:class="{
                               'ring-4 ring-slate-400/50 dark:ring-slate-600/50': activeTab === 'Settings'
                               }">
                                <a href="users.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="24" height="24" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                                    </svg>
                                </a>
                            </button>
                        <?php } else{ ?>
                            <button
                              x-on:focus="activeTab = 'article'"
                              x-on:click="activeTab = 'article'"
                               id="article-tab"
                               role="tab"
                               aria-controls="article-tab-pane"
                               x-bind:aria-selected="activeTab === 'article' ? 'true' : 'false'"
                               x-bind:tabindex="activeTab === 'article' ? '0' : '-1'"
                               type="button"
                               class="flex size-9 items-center justify-center rounded-xl bg-indigo-800 text-white hover:bg-indigo-700 active:bg-indigo-800"
                               x-bind:class="{
                             'ring-4 ring-indigo-400/50 dark:ring-indigo-600/50': activeTab === 'article'
                              }">
                              <a href="authorArticles.php">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z" />
                              </svg>
                              </a>
                           </button>

                            <?php }?>
                        
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            

                            
                        <?php } ?>

                        <!-- <button
                            x-on:click="activeTab = 'Settings'"
                            x-on:focus="activeTab = 'Settings'"
                            id="settings-tab"
                            role="tab"
                            aria-controls="settings-tab-pane"
                            x-bind:aria-selected="activeTab === 'Settings' ? 'true' : 'false'"
                            x-bind:tabindex="activeTab === 'Settings' ? '0' : '-1'"
                            type="button"
                            class="flex size-9 items-center justify-center rounded-xl bg-slate-700 text-white hover:bg-slate-600 active:bg-slate-700"
                            x-bind:class="{
                            'ring-4 ring-slate-400/50 dark:ring-slate-600/50': activeTab === 'Settings'
                          }">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                class="hi-micro hi-cog-8-tooth inline-block size-4">
                                <path
                                    fill-rule="evenodd"
                                    d="M6.955 1.45A.5.5 0 0 1 7.452 1h1.096a.5.5 0 0 1 .497.45l.17 1.699c.484.12.94.312 1.356.562l1.321-1.081a.5.5 0 0 1 .67.033l.774.775a.5.5 0 0 1 .034.67l-1.08 1.32c.25.417.44.873.561 1.357l1.699.17a.5.5 0 0 1 .45.497v1.096a.5.5 0 0 1-.45.497l-1.699.17c-.12.484-.312.94-.562 1.356l1.082 1.322a.5.5 0 0 1-.034.67l-.774.774a.5.5 0 0 1-.67.033l-1.322-1.08c-.416.25-.872.44-1.356.561l-.17 1.699a.5.5 0 0 1-.497.45H7.452a.5.5 0 0 1-.497-.45l-.17-1.699a4.973 4.973 0 0 1-1.356-.562L4.108 13.37a.5.5 0 0 1-.67-.033l-.774-.775a.5.5 0 0 1-.034-.67l1.08-1.32a4.971 4.971 0 0 1-.561-1.357l-1.699-.17A.5.5 0 0 1 1 8.548V7.452a.5.5 0 0 1 .45-.497l1.699-.17c.12-.484.312-.94.562-1.356L2.629 4.107a.5.5 0 0 1 .034-.67l.774-.774a.5.5 0 0 1 .67-.033L5.43 3.71a4.97 4.97 0 0 1 1.356-.561l.17-1.699ZM6 8c0 .538.212 1.026.558 1.385l.057.057a2 2 0 0 0 2.828-2.828l-.058-.056A2 2 0 0 0 6 8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button> -->

                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            
                        <?php } ?>



                        <button
                            type="button"
                            class="flex size-9 items-center justify-center rounded-xl border-2 border-dashed border-slate-200 text-slate-500 hover:border-slate-300 active:border-slate-200 dark:border-slate-700 dark:text-slate-400 dark:hover:border-slate-600 dark:active:border-slate-700">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                class="hi-micro hi-plus inline-block size-4">
                                <path
                                    d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                            </svg>
                        </button>
                    </nav>
                    <!-- END App Navigation -->
                </div>
                <!-- END Mini Sidebar -->

                <!-- Sidebar Content -->

                <!-- END Sidebar Content -->
            </nav>
            <!-- Page Sidebar -->

            <!-- Page Header -->
            <header
                id="page-header"
                class="fixed end-0 start-0 top-0 z-30 flex h-16 flex-none items-center border-b border-slate-200/75 bg-white backdrop-blur-sm dark:border-slate-700/60 dark:bg-slate-900 lg:start-[4rem]">
                <div
                    class="container mx-auto flex justify-between gap-2 px-4 lg:px-8 xl:max-w-7xl">
                    <!-- Left Section -->
                    <div class="flex items-center gap-2">
                        <!-- Brand -->
                        <a
                            href="javascript:void(0)"
                            class="group flex items-center justify-center text-slate-500 hover:text-slate-700 dark:hover:text-slate-400 lg:hidden">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 49 48"
                                fill="currentColor"
                                class="w-6 -rotate-6 transition group-active:rotate-0">
                                <path
                                    d="M24.5 12.75C24.5 18.963 19.463 24 13.25 24H2V12.75C2 6.537 7.037 1.5 13.25 1.5S24.5 6.537 24.5 12.75ZM24.5 35.25C24.5 29.037 29.537 24 35.75 24H47v11.25c0 6.213-5.037 11.25-11.25 11.25S24.5 41.463 24.5 35.25ZM2 35.25C2 41.463 7.037 46.5 13.25 46.5H24.5V35.25C24.5 29.037 19.463 24 13.25 24S2 29.037 2 35.25ZM47 12.75C47 6.537 41.963 1.5 35.75 1.5H24.5v11.25C24.5 18.963 29.537 24 35.75 24S47 18.963 47 12.75Z" />
                            </svg>
                        </a>
                        <!-- END Brand -->

                        <!-- Search -->
                        <div>
                            <input
                                type="text"
                                id="search"
                                name="search"
                                class="w-full rounded-lg border-slate-200 bg-white text-sm focus:border-slate-400/75 focus:ring focus:ring-slate-300/30 dark:border-slate-700/75 dark:bg-transparent dark:ring-slate-300/15 dark:placeholder:text-slate-400"
                                placeholder="Search.." />
                        </div>
                        <!-- END Search -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="flex items-center gap-2">
                        <!-- Dark Mode Toggle -->
                        <button
                            type="button"
                            class="flex items-center justify-between gap-1.5 rounded-lg bg-slate-100 px-2 py-2 text-sm font-semibold text-slate-500 hover:bg-slate-200/75 hover:text-slate-950 active:bg-slate-100 dark:bg-slate-700/50 dark:text-slate-100 dark:hover:bg-slate-700 dark:hover:text-white dark:active:bg-slate-700/50"
                            x-on:click="darkMode = !darkMode">
                            <svg
                                x-show="darkMode"
                                class="hi-mini hi-sun inline-block h-5 w-5"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M10 2a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 2zM10 15a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 15zM10 7a3 3 0 100 6 3 3 0 000-6zM15.657 5.404a.75.75 0 10-1.06-1.06l-1.061 1.06a.75.75 0 001.06 1.06l1.06-1.06zM6.464 14.596a.75.75 0 10-1.06-1.06l-1.06 1.06a.75.75 0 001.06 1.06l1.06-1.06zM18 10a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5A.75.75 0 0118 10zM5 10a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5A.75.75 0 015 10zM14.596 15.657a.75.75 0 001.06-1.06l-1.06-1.061a.75.75 0 10-1.06 1.06l1.06 1.06zM5.404 6.464a.75.75 0 001.06-1.06l-1.06-1.06a.75.75 0 10-1.061 1.06l1.06 1.06z" />
                            </svg>
                            <svg
                                x-cloak
                                x-show="!darkMode"
                                class="hi-mini hi-moon inline-block h-5 w-5"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                    fill-rule="evenodd"
                                    d="M7.455 2.004a.75.75 0 01.26.77 7 7 0 009.958 7.967.75.75 0 011.067.853A8.5 8.5 0 116.647 1.921a.75.75 0 01.808.083z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- END Dark Mode Toggle -->

                    

                        <!-- Notifications -->
                        <button
                            type="button"
                            class="relative flex items-center justify-between gap-1.5 rounded-lg bg-slate-100 px-2 py-2 text-sm font-semibold text-slate-500 hover:bg-slate-200/75 hover:text-slate-950 active:bg-slate-100 dark:bg-slate-700/50 dark:text-slate-100 dark:hover:bg-slate-700 dark:hover:text-white dark:active:bg-slate-700/50">
                            <div
                                class="absolute -end-1.5 -top-2.5 inline-flex h-5 min-w-5 items-center justify-center rounded-lg bg-slate-700 px-1 text-xs font-medium text-white dark:bg-slate-300 dark:font-semibold dark:text-slate-900">
                                3
                            </div>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                class="hi-mini hi-bell-alert inline-block size-5">
                                <path
                                    d="M4.214 3.227a.75.75 0 0 0-1.156-.955 8.97 8.97 0 0 0-1.856 3.825.75.75 0 0 0 1.466.316 7.47 7.47 0 0 1 1.546-3.186ZM16.942 2.272a.75.75 0 0 0-1.157.955 7.47 7.47 0 0 1 1.547 3.186.75.75 0 0 0 1.466-.316 8.971 8.971 0 0 0-1.856-3.825Z" />
                                <path
                                    fill-rule="evenodd"
                                    d="M10 2a6 6 0 0 0-6 6c0 1.887-.454 3.665-1.257 5.234a.75.75 0 0 0 .515 1.076 32.91 32.91 0 0 0 3.256.508 3.5 3.5 0 0 0 6.972 0 32.903 32.903 0 0 0 3.256-.508.75.75 0 0 0 .515-1.076A11.448 11.448 0 0 1 16 8a6 6 0 0 0-6-6Zm0 14.5a2 2 0 0 1-1.95-1.557 33.54 33.54 0 0 0 3.9 0A2 2 0 0 1 10 16.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- END Notifications -->

                        <div x-data="{ isOpen: false }" class="relative inline-block ">
    <!-- Dropdown toggle button -->
    <button @click="isOpen = !isOpen" class="relative z-10 flex items-center p-2 text-sm text-gray-600 bg-white border border-transparent rounded-md focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:text-white dark:bg-gray-800 focus:outline-none">
        <span class="mx-1"><?= $_SESSION["username"] ?></span>
        <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 15.713L18.01 9.70299L16.597 8.28799L12 12.888L7.40399 8.28799L5.98999 9.70199L12 15.713Z" fill="currentColor"></path>
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div x-show="isOpen" 
        @click.away="isOpen = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="absolute right-0 z-20 w-56 py-2 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800"
    >
        <a href="#" class="flex items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
            <img class="flex-shrink-0 object-cover mx-1 rounded-full w-9 h-9" src="https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200" alt="jane avatar">
            <div class="mx-1">
                <h1 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Jane Doe</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">janedoe@exampl.com</p>
            </div>
        </a>

        <hr class="border-gray-200 dark:border-gray-700 ">

        <a href="#" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8C17 10.7614 14.7614 13 12 13C9.23858 13 7 10.7614 7 8ZM12 11C13.6569 11 15 9.65685 15 8C15 6.34315 13.6569 5 12 5C10.3431 5 9 6.34315 9 8C9 9.65685 10.3431 11 12 11Z" fill="currentColor"></path>
                <path d="M6.34315 16.3431C4.84285 17.8434 4 19.8783 4 22H6C6 20.4087 6.63214 18.8826 7.75736 17.7574C8.88258 16.6321 10.4087 16 12 16C13.5913 16 15.1174 16.6321 16.2426 17.7574C17.3679 18.8826 18 20.4087 18 22H20C20 19.8783 19.1571 17.8434 17.6569 16.3431C16.1566 14.8429 14.1217 14 12 14C9.87827 14 7.84344 14.8429 6.34315 16.3431Z" fill="currentColor"></path>
            </svg>

            <span class="mx-1">
                view profile
            </span>
        </a>

        <a href="#" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.8199 22H10.1799C9.71003 22 9.30347 21.673 9.20292 21.214L8.79592 19.33C8.25297 19.0921 7.73814 18.7946 7.26092 18.443L5.42392 19.028C4.97592 19.1709 4.48891 18.9823 4.25392 18.575L2.42992 15.424C2.19751 15.0165 2.27758 14.5025 2.62292 14.185L4.04792 12.885C3.98312 12.2961 3.98312 11.7019 4.04792 11.113L2.62292 9.816C2.27707 9.49837 2.19697 8.98372 2.42992 8.576L4.24992 5.423C4.48491 5.0157 4.97192 4.82714 5.41992 4.97L7.25692 5.555C7.50098 5.37416 7.75505 5.20722 8.01792 5.055C8.27026 4.91269 8.52995 4.78385 8.79592 4.669L9.20392 2.787C9.30399 2.32797 9.71011 2.00049 10.1799 2H13.8199C14.2897 2.00049 14.6958 2.32797 14.7959 2.787L15.2079 4.67C15.4887 4.79352 15.7622 4.93308 16.0269 5.088C16.2739 5.23081 16.5126 5.38739 16.7419 5.557L18.5799 4.972C19.0276 4.82967 19.514 5.01816 19.7489 5.425L21.5689 8.578C21.8013 8.98548 21.7213 9.49951 21.3759 9.817L19.9509 11.117C20.0157 11.7059 20.0157 12.3001 19.9509 12.889L21.3759 14.189C21.7213 14.5065 21.8013 15.0205 21.5689 15.428L19.7489 18.581C19.514 18.9878 19.0276 19.1763 18.5799 19.034L16.7419 18.449C16.5093 18.6203 16.2677 18.7789 16.0179 18.924C15.7557 19.0759 15.4853 19.2131 15.2079 19.335L14.7959 21.214C14.6954 21.6726 14.2894 21.9996 13.8199 22ZM7.61992 16.229L8.43992 16.829C8.62477 16.9652 8.81743 17.0904 9.01692 17.204C9.20462 17.3127 9.39788 17.4115 9.59592 17.5L10.5289 17.909L10.9859 20H13.0159L13.4729 17.908L14.4059 17.499C14.8132 17.3194 15.1998 17.0961 15.5589 16.833L16.3799 16.233L18.4209 16.883L19.4359 15.125L17.8529 13.682L17.9649 12.67C18.0141 12.2274 18.0141 11.7806 17.9649 11.338L17.8529 10.326L19.4369 8.88L18.4209 7.121L16.3799 7.771L15.5589 7.171C15.1997 6.90671 14.8132 6.68175 14.4059 6.5L13.4729 6.091L13.0159 4H10.9859L10.5269 6.092L9.59592 6.5C9.39772 6.58704 9.20444 6.68486 9.01692 6.793C8.81866 6.90633 8.62701 7.03086 8.44292 7.166L7.62192 7.766L5.58192 7.116L4.56492 8.88L6.14792 10.321L6.03592 11.334C5.98672 11.7766 5.98672 12.2234 6.03592 12.666L6.14792 13.678L4.56492 15.121L5.57992 16.879L7.61992 16.229ZM11.9959 16C9.78678 16 7.99592 14.2091 7.99592 12C7.99592 9.79086 9.78678 8 11.9959 8C14.2051 8 15.9959 9.79086 15.9959 12C15.9932 14.208 14.2039 15.9972 11.9959 16ZM11.9959 10C10.9033 10.0011 10.0138 10.8788 9.99815 11.9713C9.98249 13.0638 10.8465 13.9667 11.9386 13.9991C13.0307 14.0315 13.9468 13.1815 13.9959 12.09V12.49V12C13.9959 10.8954 13.1005 10 11.9959 10Z" fill="currentColor"></path>
            </svg>

            <span class="mx-1">
                Settings
            </span>
        </a>

        <a href="#" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 19H3C1.89543 19 1 18.1046 1 17V16H3V7C3 5.89543 3.89543 5 5 5H19C20.1046 5 21 5.89543 21 7V16H23V17C23 18.1046 22.1046 19 21 19ZM5 7V16H19V7H5Z" fill="currentColor"></path>
            </svg>

            <span class="mx-1">
                Keyboard shortcuts
            </span>
        </a>

        <hr class="border-gray-200 dark:border-gray-700 ">

        <a href="#" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 22C15.8082 21.9947 14.0267 20.2306 14 18.039V16H9.99996V18.02C9.98892 20.2265 8.19321 22.0073 5.98669 22C3.78017 21.9926 1.99635 20.1999 2.00001 17.9934C2.00367 15.7868 3.79343 14 5.99996 14H7.99996V9.99999H5.99996C3.79343 9.99997 2.00367 8.21315 2.00001 6.00663C1.99635 3.8001 3.78017 2.00736 5.98669 1.99999C8.19321 1.99267 9.98892 3.77349 9.99996 5.97999V7.99999H14V5.99999C14 3.79085 15.7908 1.99999 18 1.99999C20.2091 1.99999 22 3.79085 22 5.99999C22 8.20913 20.2091 9.99999 18 9.99999H16V14H18C20.2091 14 22 15.7909 22 18C22 20.2091 20.2091 22 18 22ZM16 16V18C16 19.1046 16.8954 20 18 20C19.1045 20 20 19.1046 20 18C20 16.8954 19.1045 16 18 16H16ZM5.99996 16C4.89539 16 3.99996 16.8954 3.99996 18C3.99996 19.1046 4.89539 20 5.99996 20C6.53211 20.0057 7.04412 19.7968 7.42043 19.4205C7.79674 19.0442 8.00563 18.5321 7.99996 18V16H5.99996ZM9.99996 9.99999V14H14V9.99999H9.99996ZM18 3.99999C17.4678 3.99431 16.9558 4.2032 16.5795 4.57952C16.2032 4.95583 15.9943 5.46784 16 5.99999V7.99999H18C18.5321 8.00567 19.0441 7.79678 19.4204 7.42047C19.7967 7.04416 20.0056 6.53215 20 5.99999C20.0056 5.46784 19.7967 4.95583 19.4204 4.57952C19.0441 4.2032 18.5321 3.99431 18 3.99999ZM5.99996 3.99999C5.4678 3.99431 4.95579 4.2032 4.57948 4.57952C4.20317 4.95583 3.99428 5.46784 3.99996 5.99999C3.99428 6.53215 4.20317 7.04416 4.57948 7.42047C4.95579 7.79678 5.4678 8.00567 5.99996 7.99999H7.99996V5.99999C8.00563 5.46784 7.79674 4.95583 7.42043 4.57952C7.04412 4.2032 6.53211 3.99431 5.99996 3.99999Z" fill="currentColor"></path>
            </svg>

            <span class="mx-1">
                Company profile
            </span>
        </a>

        <a href="#" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 3C6.23858 3 4 5.23858 4 8C4 10.7614 6.23858 13 9 13C11.7614 13 14 10.7614 14 8C14 5.23858 11.7614 3 9 3ZM6 8C6 6.34315 7.34315 5 9 5C10.6569 5 12 6.34315 12 8C12 9.65685 10.6569 11 9 11C7.34315 11 6 9.65685 6 8Z" fill="currentColor"></path>
                <path d="M16.9084 8.21828C16.6271 8.07484 16.3158 8.00006 16 8.00006V6.00006C16.6316 6.00006 17.2542 6.14956 17.8169 6.43645C17.8789 6.46805 17.9399 6.50121 18 6.5359C18.4854 6.81614 18.9072 7.19569 19.2373 7.65055C19.6083 8.16172 19.8529 8.75347 19.9512 9.37737C20.0496 10.0013 19.9987 10.6396 19.8029 11.2401C19.6071 11.8405 19.2719 12.3861 18.8247 12.8321C18.3775 13.2782 17.8311 13.6119 17.2301 13.8062C16.6953 13.979 16.1308 14.037 15.5735 13.9772C15.5046 13.9698 15.4357 13.9606 15.367 13.9496C14.7438 13.8497 14.1531 13.6038 13.6431 13.2319L13.6421 13.2311L14.821 11.6156C15.0761 11.8017 15.3717 11.9248 15.6835 11.9747C15.9953 12.0247 16.3145 12.0001 16.615 11.903C16.9155 11.8059 17.1887 11.639 17.4123 11.416C17.6359 11.193 17.8035 10.9202 17.9014 10.62C17.9993 10.3198 18.0247 10.0006 17.9756 9.68869C17.9264 9.37675 17.8041 9.08089 17.6186 8.82531C17.4331 8.56974 17.1898 8.36172 16.9084 8.21828Z" fill="currentColor"></path>
                <path d="M19.9981 21C19.9981 20.475 19.8947 19.9551 19.6938 19.47C19.4928 18.9849 19.1983 18.5442 18.8271 18.1729C18.4558 17.8017 18.0151 17.5072 17.53 17.3062C17.0449 17.1053 16.525 17.0019 16 17.0019V15C16.6821 15 17.3584 15.1163 18 15.3431C18.0996 15.3783 18.1983 15.4162 18.2961 15.4567C19.0241 15.7583 19.6855 16.2002 20.2426 16.7574C20.7998 17.3145 21.2417 17.9759 21.5433 18.7039C21.5838 18.8017 21.6217 18.9004 21.6569 19C21.8837 19.6416 22 20.3179 22 21H19.9981Z" fill="currentColor"></path>
                <path d="M16 21H14C14 18.2386 11.7614 16 9 16C6.23858 16 4 18.2386 4 21H2C2 17.134 5.13401 14 9 14C12.866 14 16 17.134 16 21Z" fill="currentColor"></path>
            </svg>

            <span class="mx-1">Team</span>
        </a>

        <a href="#" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 19H2C2 15.6863 4.68629 13 8 13C11.3137 13 14 15.6863 14 19H12C12 16.7909 10.2091 15 8 15C5.79086 15 4 16.7909 4 19ZM19 16H17V13H14V11H17V8H19V11H22V13H19V16ZM8 12C5.79086 12 4 10.2091 4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8C11.9972 10.208 10.208 11.9972 8 12ZM8 6C6.9074 6.00111 6.01789 6.87885 6.00223 7.97134C5.98658 9.06383 6.85057 9.9667 7.94269 9.99912C9.03481 10.0315 9.95083 9.1815 10 8.09V8.49V8C10 6.89543 9.10457 6 8 6Z" fill="currentColor"></path>
            </svg>

            <span class="mx-1">
                Invite colleagues
            </span>
        </a>

        <hr class="border-gray-200 dark:border-gray-700 ">

        <a href="#" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22C6.47967 21.9939 2.00606 17.5203 2 12V11.8C2.10993 6.30452 6.63459 1.92794 12.1307 2.00087C17.6268 2.07379 22.0337 6.56887 21.9978 12.0653C21.9619 17.5618 17.4966 21.9989 12 22ZM11.984 20H12C16.4167 19.9956 19.9942 16.4127 19.992 11.996C19.9898 7.57928 16.4087 3.99999 11.992 3.99999C7.57528 3.99999 3.99421 7.57928 3.992 11.996C3.98979 16.4127 7.56729 19.9956 11.984 20ZM13 18H11V16H13V18ZM13 15H11C10.9684 13.6977 11.6461 12.4808 12.77 11.822C13.43 11.316 14 10.88 14 9.99999C14 8.89542 13.1046 7.99999 12 7.99999C10.8954 7.99999 10 8.89542 10 9.99999H8V9.90999C8.01608 8.48093 8.79333 7.16899 10.039 6.46839C11.2846 5.76778 12.8094 5.78493 14.039 6.51339C15.2685 7.24184 16.0161 8.57093 16 9.99999C15.9284 11.079 15.3497 12.0602 14.44 12.645C13.6177 13.1612 13.0847 14.0328 13 15Z" fill="currentColor"></path>
            </svg>

            <span class="mx-1">
                Help
            </span>
        </a>
        <a href="#" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 21H10C8.89543 21 8 20.1046 8 19V15H10V19H19V5H10V9H8V5C8 3.89543 8.89543 3 10 3H19C20.1046 3 21 3.89543 21 5V19C21 20.1046 20.1046 21 19 21ZM12 16V13H3V11H12V8L17 12L12 16Z" fill="currentColor"></path>
            </svg>

            <span class="mx-1">
                Sign Out
            </span>
        </a>
    </div>
</div>

                        <!-- Toggle Sidebar on Mobile -->
                        <button
                            type="button"
                            class="flex items-center justify-between gap-1.5 rounded-lg bg-slate-100 px-2 py-2 text-sm font-semibold text-slate-500 hover:bg-slate-200/75 hover:text-slate-950 active:bg-slate-100 dark:bg-slate-700/50 dark:text-slate-100 dark:hover:bg-slate-700 dark:hover:text-white dark:active:bg-slate-700/50 lg:hidden"
                            x-on:click="mobileSidebarOpen = true">
                            <svg
                                class="hi-solid hi-menu-alt-1 inline-block size-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- END Toggle Sidebar on Mobile -->
                    </div>
                    <!-- END Right Section -->
                </div>
            </header>
            <!-- END Page Header -->

            <!-- Page Content -->
            <main
                id="page-content"
                class="grow bg-slate-100 pt-16 dark:bg-slate-950">
                <div class="container mx-auto px-4 py-4 lg:p-8 xl:max-w-7xl">
                    <div class=" grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-4" id="categoryTable">
                        <!-- Popular Pages -->
                        <div
                            class="flex flex-col justify-center overflow-hidden rounded-lg bg-white p-6 ring-1 ring-slate-200/50 dark:bg-slate-900 dark:ring-slate-700/60 xl:col-span-4">
                            <div class="mb-6 flex items-center justify-between gap-4">
                                <h2 class="text-xl font-extrabold">Users </h2>
                                <button
                                    id="showCategoryForm"
                                    type="button"
                                    class="flex items-center justify-between gap-1.5 rounded-lg bg-slate-100 px-2 py-2 text-sm font-semibold text-slate-500 hover:bg-slate-200/75 hover:text-slate-950 active:bg-slate-100 dark:bg-slate-700/50 dark:text-slate-100 dark:hover:bg-slate-700 dark:hover:text-white dark:active:bg-slate-700/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" viewBox="0 0 512 512" width="24"
                                        height="24" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm  ">
                                    <thead>
                                        <tr>
                                            <th
                                                class="w-1/8 py-2 pe-2 text-start font-medium text-slate-500 dark:text-slate-400">
                                                id
                                            </th>

                                            <th
                                                class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                                username
                                            </th>

                                            <th
                                                class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                                profile picture
                                            </th>

                                            <th
                                                class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                                email
                                            </th>
                                            <th
                                                class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                                bio
                                            </th>
                                            <th
                                                class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                                role
                                            </th>
                                            <th
                                                class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                                actions
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($user as $us) : ?>
                                            <tr>
                                                <td class="relative p-2">
                                                    <?= $us['id']; ?>
                                                </td>
                                                <td class="relative p-2">
                                                    <?= $us['username'] ?>
                                                </td>
                                                <td class="relative p-2">
                                                    <img src="../assets/articleimages/<?= $us['profile_picture_url'] ?>" alt="" width="100" height="100">
                                                </td>
                                                <td class="relative p-2">
                                                    <?= $us['email'] ?>
                                                </td>
                                                <td class="relative p-2">
                                                    <?= $us['bio'] ?>
                                                </td>
                                                <td class="relative p-2">
                                                    <?= $us['role'] ?>
                                                </td>
                                                
                                                <td class="relative p-2">
                                                    <div class="flex">
                                                        <a href="edituser.php?action=update&id=<?= $us['id']; ?>" id="update"
                                                            name="update">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24"
                                                                height="24" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                                                <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z" />
                                                            </svg>
                                                        </a>

                                                        <a href="users.php?action=delete&id=<?= $us['id']; ?>" id="delete"
                                                            name="delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24"
                                                                height="24" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                                                <path d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- END Referrers -->

                    </div>
                    <div id="categoryForm" class=" hidden flex flex-col justify-center overflow-hidden rounded-lg bg-white p-6 ring-1 ring-slate-200/50 dark:bg-slate-900 dark:ring-slate-700/60 xl:col-span-4 justify-center ">

                        <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-800 py-8">
                            <div class="w-full max-w-xl bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">

                                <form action="users.php?action=create" method="POST" enctype="multipart/form-data">
                                    <div class="mb-4">
                                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Image</label>
                                        <input type="file" id="image" name="image"
                                            class="block w-full text-sm text-gray-900 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-600">
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

                                        <div>
                                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                            <input type="text" id="username" name="username" placeholder="username"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                            <input type="email" id="email" name="email" placeholder="email"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Excerpt</label>
                                        <input type="text" id="password" name="password" placeholder="password"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                                        <textarea id="bio" name="bio" rows="4"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                    </div>

                                    <button type="submit"
                                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                        Add User
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- END Page Content -->

            <!-- Page Footer -->
            <footer
                id="page-footer"
                class="flex grow-0 items-center border-t border-dashed border-slate-200/75 bg-slate-100 dark:border-slate-700/75 dark:bg-slate-950">
                <div
                    class="container mx-auto flex flex-col gap-2 px-4 py-6 text-center text-sm font-medium text-slate-600 dark:text-slate-400 md:flex-row md:justify-between md:gap-0 md:text-start lg:px-8 xl:max-w-7xl">

                </div>
            </footer>
            <!-- END Page Footer -->
        </div>
        <!-- END Page Container -->
    </div>

    <script src="../assets/js/script.js"></script>
    <script>
        const categoryTable = document.getElementById("categoryTable");
        const categoryForm = document.getElementById("categoryForm");
        const showCategoryForm = document.getElementById("showCategoryForm");
        showCategoryForm.addEventListener("click", (e) => {
            e.preventDefault();
            // console.log("clicked")
            categoryTable.classList.add("hidden");
            categoryForm.classList.remove("hidden")
        })
    </script>
</body>

</html>
