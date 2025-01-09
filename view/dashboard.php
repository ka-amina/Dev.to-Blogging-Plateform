<?php
require_once '../app/config/connexion.php';
require '../vendor/autoload.php';

session_start();

use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\TagController;
use App\Controllers\userController;

$articleCounter = new ArticleController();
$tagCounter = new TagController();
$categoryCounter = new CategoryController();
$users=new userController();

$articleCount = $articleCounter->countArticles();
$tagCount = $tagCounter->sumTags();
$categoryCount = $categoryCounter->countCategories();
$user = $users->getTopUsers();
$recentArticles=$articleCounter->getRecentArticles();
$usersCount=$users->countUsers();

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

                        <button
                            id="analytics-tab"
                            role="tab"
                            aria-controls="analytics-tab-pane"
                            type="button"
                            class="flex size-9 items-center justify-center rounded-xl bg-green-700 text-white hover:bg-green-600 active:bg-green-700">
                            <a href="home.php">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185l0-121c0-17.7-14.3-32-32-32l-32 0c-17.7 0-32 14.3-32 32l0 36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1l32 0 0 69.7c-.1 .9-.1 1.8-.1 2.8l0 112c0 22.1 17.9 40 40 40l16 0c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2l31.9 0 24 0c22.1 0 40-17.9 40-40l0-24 0-64c0-17.7 14.3-32 32-32l64 0c17.7 0 32 14.3 32 32l0 64 0 24c0 22.1 17.9 40 40 40l24 0 32.5 0c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1l16 0c22.1 0 40-17.9 40-40l0-16.2c.3-2.6 .5-5.3 .5-8.1l-.7-160.2 32 0z"/></svg>
                            </a>
                        </button>

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
                                class="absolute right-0 z-20 w-56 py-2 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800">
                                <a href="#" class="flex items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <img class="flex-shrink-0 object-cover mx-1 rounded-full w-9 h-9" src="https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200" alt="jane avatar">
                                    <div class="mx-1">
                                        <h1 class="text-sm font-semibold text-gray-700 dark:text-gray-200"><?= $_SESSION["username"] ?></h1>
                                        <p class="text-sm text-gray-500 dark:text-gray-400"><?= $_SESSION["email"] ?></p>
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






                                <hr class="border-gray-200 dark:border-gray-700 ">


                                <a href="login.php" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
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
                    <div
                        class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-4">
                        <a
                            href="javascript:void(0)"
                            class="flex flex-col justify-center overflow-hidden rounded-lg bg-white ring-1 ring-slate-200/50 transition-opacity duration-100 hover:opacity-70 active:opacity-100 dark:bg-slate-900 dark:ring-slate-700/60">
                            <div class="flex items-center justify-between gap-3 p-6">
                                <div class="grow">
                                    <div
                                        class="flex items-center gap-0.5 text-sm font-medium text-emerald-500">
                                        <span>Articles</span>
                                    </div>
                                    <dt class="text-2xl font-extrabold"><?= htmlspecialchars($articleCount) ?></dt>

                                </div>
                                <div class="relative w-full max-w-28">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z" />
                                    </svg>


                                </div>
                            </div>
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="flex flex-col justify-center overflow-hidden rounded-lg bg-white ring-1 ring-slate-200/50 transition-opacity duration-100 hover:opacity-70 active:opacity-100 dark:bg-slate-900 dark:ring-slate-700/60">
                            <div class="flex items-center justify-between gap-3 p-5">
                                <div class="grow">
                                    <div
                                        class="flex items-center gap-0.5 text-sm font-medium text-emerald-500">
                                        <span>Users</span>

                                    </div>
                                    <dl>
                                        <dt class="text-2xl font-extrabold"><?= htmlspecialchars($usersCount) ?></dt>
                                    </dl>
                                </div>
                                <div class="relative w-full max-w-28">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="flex flex-col justify-center overflow-hidden rounded-lg bg-white ring-1 ring-slate-200/50 transition-opacity duration-100 hover:opacity-70 active:opacity-100 dark:bg-slate-900 dark:ring-slate-700/60">
                            <div class="flex items-center justify-between gap-3 p-5">
                                <div class="grow">
                                    <div
                                        class="flex items-center gap-0.5 text-sm font-medium text-emerald-500">
                                        <span>Tags</span>
                                    </div>
                                    <dl>
                                        <dt class="text-2xl font-extrabold"><?= htmlspecialchars($tagCount) ?></dt>
                                    </dl>
                                </div>
                                <div class="relative w-full max-w-28">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M0 80L0 229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7L48 32C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="flex flex-col justify-center overflow-hidden rounded-lg bg-white ring-1 ring-slate-200/50 transition-opacity duration-100 hover:opacity-70 active:opacity-100 dark:bg-slate-900 dark:ring-slate-700/60">
                            <div class="flex items-center justify-between gap-3 p-5">
                                <div class="grow">
                                    <div
                                        class="flex items-center gap-0.5 text-sm font-medium text-emerald-500">
                                        <span>Categories</span>
                                    </div>
                                    <dl>
                                        <dt class="text-2xl font-extrabold"><?= htmlspecialchars($categoryCount) ?></dt>
                                    </dl>
                                </div>
                                <div class="relative w-full max-w-28">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40" height="40" fill="currentColor"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <!-- END Mini Stats -->

                        <!-- Pageviews -->
                        <div
                            class="flex flex-col justify-center overflow-hidden rounded-lg bg-white ring-1 ring-slate-200/50 dark:bg-slate-900 dark:ring-slate-700/60 xl:col-span-2">
                            <div class="mb-6 flex items-center justify-between gap-4 p-6">
                                <h2 class="text-xl font-extrabold">
                                    Top Articles
                                </h2>
                                <button
                                    type="button"
                                    class="flex items-center justify-between gap-1.5 rounded-lg bg-slate-100 px-2 py-2 text-sm font-semibold text-slate-500 hover:bg-slate-200/75 hover:text-slate-950 active:bg-slate-100 dark:bg-slate-700/50 dark:text-slate-100 dark:hover:bg-slate-700 dark:hover:text-white dark:active:bg-slate-700/50">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        class="hi-mini hi-arrow-up-right inline-block size-5">
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.22 14.78a.75.75 0 0 0 1.06 0l7.22-7.22v5.69a.75.75 0 0 0 1.5 0v-7.5a.75.75 0 0 0-.75-.75h-7.5a.75.75 0 0 0 0 1.5h5.69l-7.22 7.22a.75.75 0 0 0 0 1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Example SVG Chart -->
                            <?php foreach ($user as $u) : ?>
                            <div class="flex items-center mb-3 ml-8">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary text-white">

                                        <img src="../assets/articleimages/<?= $u['profile_picture_url'] ?>"
                                            class="rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;"
                                            alt="">

                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="small text-gray-500"><?= $u['username']?></div>
                                    <div class="font-weight-bold"></div>
                                    <div class="text-gray-800 ml-2">
                                        articles <?= $u['article_count']?>
                                        <span class="mx-1">•</span>
                                        total views: <?= $u['viewsAll']?>
                                    </div>
                                </div>
                                <div class="ml-2">
                                    <a href="./entities/users/user-profile.php?id="
                                        class="btn btn-primary btn-sm">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <!-- END Example SVG Chart -->
                        </div>
                        <!-- END Pageviews -->

                        <!-- Sales -->
                        <div
                            class="flex flex-col justify-center overflow-hidden rounded-lg bg-white ring-1 ring-slate-200/50 dark:bg-slate-900 dark:ring-slate-700/60 xl:col-span-2">
                            <div class="mb-6 flex items-center justify-between gap-4 p-6">
                                <h2 class="text-xl font-extrabold">
                                    Category Distribution
                                </h2>
                                <button
                                    type="button"
                                    class="flex items-center justify-between gap-1.5 rounded-lg bg-slate-100 px-2 py-2 text-sm font-semibold text-slate-500 hover:bg-slate-200/75 hover:text-slate-950 active:bg-slate-100 dark:bg-slate-700/50 dark:text-slate-100 dark:hover:bg-slate-700 dark:hover:text-white dark:active:bg-slate-700/50">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        class="hi-mini hi-arrow-up-right inline-block size-5">
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.22 14.78a.75.75 0 0 0 1.06 0l7.22-7.22v5.69a.75.75 0 0 0 1.5 0v-7.5a.75.75 0 0 0-.75-.75h-7.5a.75.75 0 0 0 0 1.5h5.69l-7.22 7.22a.75.75 0 0 0 0 1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Example SVG Chart -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="categoryPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">

                                    <span class="mr-2">
                                        <i class="fas fa-circle"></i>


                                    </span>

                                </div>
                            </div>
                            <!-- END Example SVG Chart -->
                        </div>
                        <!-- END Sales -->

                        <!-- Popular Pages -->
                        <div
                            class="flex flex-col justify-center overflow-hidden rounded-lg bg-white p-6 ring-1 ring-slate-200/50 dark:bg-slate-900 dark:ring-slate-700/60 xl:col-span-4">
                            <div class="mb-6 flex items-center justify-between gap-4">
                                <h2 class="text-xl font-extrabold">Recent Articles</h2>
                                <button
                                    type="button"
                                    class="flex items-center justify-between gap-1.5 rounded-lg bg-slate-100 px-2 py-2 text-sm font-semibold text-slate-500 hover:bg-slate-200/75 hover:text-slate-950 active:bg-slate-100 dark:bg-slate-700/50 dark:text-slate-100 dark:hover:bg-slate-700 dark:hover:text-white dark:active:bg-slate-700/50">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        class="hi-mini hi-arrow-up-right inline-block size-5">
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.22 14.78a.75.75 0 0 0 1.06 0l7.22-7.22v5.69a.75.75 0 0 0 1.5 0v-7.5a.75.75 0 0 0-.75-.75h-7.5a.75.75 0 0 0 0 1.5h5.69l-7.22 7.22a.75.75 0 0 0 0 1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <table class="w-full text-sm">
                                <thead>
                                    <tr>
                                        <th
                                            class="py-2 pe-2 text-start font-medium text-slate-500 dark:text-slate-400">
                                            title
                                        </th>
                                        <th
                                            class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                            Author
                                        </th>
                                        <th
                                            class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                            Category
                                        </th>
                                        <th
                                            class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                            Tags
                                        </th>
                                        <th
                                            class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                            Views
                                        </th>
                                        <th
                                            class="py-2 ps-2 text-end font-medium text-slate-500 dark:text-slate-400">
                                            Created At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php foreach ($recentArticles as $recent) : ?>
                                    <tr>
                                        <td class="relative p-2">
                                            <?= $recent['title']?>
                                        </td>
                                        <td class="relative p-2">
                                        <?= $recent['author_name']?>
                                        </td>
                                        <td class="relative p-2">
                                        <?= $recent['category_name']?>
                                        </td>
                                        <td class="relative p-2">
                                        <?= $recent['tag_names']?>
                                        </td>
                                        <td class="relative p-2">
                                        <?= $recent['views']?>
                                        </td>
                                        <td class="relative p-2">
                                        <?= $recent['created_at']?>
                                        </td>

                                    </tr>
                                    <?php endforeach;?>

                                </tbody>
                            </table>

                        </div>
                        <!-- END Referrers -->
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
</body>

</html>