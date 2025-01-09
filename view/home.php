<?php
// require_once '../app/config/connexion.php';
// require '../vendor/autoload.php';

// use App\Controllers\CategoryController;
// use App\Controllers\TagController;
// use App\Controllers\ArticleController;


// $controller = new CategoryController();
// $Tag=new TagController;
// $article= new ArticleController();

// $categories = $controller->listCategories();
// print_r($categories);

// $controller->deleteCategory(['id' => 2]);
// $controller->createCategory(['name'=> 'cyber security']);
// $controller->updateCategory(['name'=>'test'],['id'=>6]) ;

// tags
// $tags= $Tag->listTags();
// print_r($tags);

// $Tag->deleteTag(['id'=> 8 ]);
// $Tag->createTag(['name'=>'hi']);

// $Tag->updateTag(['name'=> 'smile'], ['id'=>11]);

// articles
// $articles= $Tag->listTags();
// foreach ($articles as $article) {
//     echo "Article ID: " . $article['id'] . "<br>";  // Display article id
// }

// $article->deleteArticle(['id'=>5]);

// $article->createArticle(['title'=>'Getting Started with React Hooks','slug'=>'test','content'=>'React Hooks are a powerful feature that allows you to use state and other React features without writing a class component...','excerpt'=>'Learn how to use React Hooks in your applications','meta_description'=>'A comprehensive guide to React Hooks for beginners','category_id'=>1,'featured_image'=>'images/react-hooks.jpg','status'=>'published','scheduled_date'=>NULL,'author_id'=>'5']);

// $article->updateArticle(['slug'=>'test2'],['id'=>9]);
// $articleCount = $article->countArticles();
// print_r($articleCount);
require_once '../app/config/connexion.php';
require '../vendor/autoload.php';

use App\Controllers\ArticleController;
use App\Controllers\AdminController;
// use App\Controllers\userController;

// $user= new userController();
// $user->incrementViews(1);
// $admin= new AdminController();
$articleList = new ArticleController();
// $admin->reviewArticle(['status'=>'draft'],['id'=>1]);
$articles = $articleList->listArticles();
// foreach ($articles as $a) {
//       echo "Article ID: " . $a['id'] . "v: ". $a['views']. "status: ".$a['status']."<br> ";  // Display article id
//   }

// if (isset($_GET['action']) && $_GET['action'] == 'create') {
//     $categoryList->createCategory($_POST);
// }

// if (isset($_GET['action']) && $_GET['action'] == 'delete'){
//     $categoryList->deleteCategory($_GET['id']);
// }
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
  x-data="{ mobileSidebarOpen: false, darkMode: false }"
  x-bind:class="{ 'dark': darkMode }"
>
  <!-- Page Container -->
  <div
    id="page-container"
    class="mx-auto flex min-h-screen w-full min-w-[320px] flex-col bg-slate-100 dark:bg-slate-900 dark:text-slate-200 lg:ps-64"
  >
    <!-- Page Sidebar -->
    <nav
      id="page-sidebar"
      class="fixed bottom-0 start-0 top-0 z-50 flex h-full w-80 flex-col bg-white transition-transform duration-500 ease-out dark:bg-slate-800 lg:w-64 lg:translate-x-0 lg:border-sky-900/10 dark:lg:border-slate-700/25 ltr:lg:translate-x-0 ltr:lg:border-r-4 rtl:lg:translate-x-0 rtl:lg:border-l-4"
      x-bind:class="{
        'ltr:-translate-x-full rtl:translate-x-full': !mobileSidebarOpen,
        'translate-x-0': mobileSidebarOpen,
      }"
      aria-label="Main Sidebar Navigation"
      x-cloak
    >
      <!-- Sidebar Header -->
      <div
        class="flex h-20 w-full flex-none items-center justify-between pe-4 ps-8"
      >
        <!-- Brand -->
        <a
          href="javascript:void(0)"
          class="inline-flex items-center gap-2 text-lg font-semibold tracking-wide text-slate-800 transition hover:opacity-75 active:opacity-100 dark:text-slate-200"
        >
          <svg
            class="hi-mini hi-bolt inline h-5 w-5 text-sky-500"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              d="M11.983 1.907a.75.75 0 00-1.292-.657l-8.5 9.5A.75.75 0 002.75 12h6.572l-1.305 6.093a.75.75 0 001.292.657l8.5-9.5A.75.75 0 0017.25 8h-6.572l1.305-6.093z"
            />
          </svg>
          <span
            >Tail<span class="text-sky-600 dark:text-sky-500"
              >Social</span
            ></span
          >
        </a>
        <!-- END Brand -->

        <!-- Extra Actions -->
        <div class="flex items-center">
          <!-- Dark Mode Toggle -->
          <button
            type="button"
            class="flex h-10 w-10 items-center justify-center text-slate-400 hover:text-slate-600 active:text-slate-400"
            x-on:click="darkMode = !darkMode"
          >
            <svg
              x-show="!darkMode"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="hi-outline hi-moon inline-block h-5 w-5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"
              />
            </svg>
            <svg
              x-cloak
              x-show="darkMode"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="hi-outline hi-sun inline-block h-5 w-5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
              />
            </svg>
          </button>
          <!-- END Dark Mode Toggle -->

          <!-- Close Sidebar on Mobile -->
          <button
            type="button"
            class="flex h-10 w-10 items-center justify-center text-slate-400 hover:text-slate-600 active:text-slate-400 lg:hidden"
            x-on:click="mobileSidebarOpen = false"
          >
            <svg
              class="hi-solid hi-x -mx-1 inline-block h-5 w-5"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
          <!-- END Close Sidebar on Mobile -->
        </div>
        <!-- END Extra Actions -->
      </div>
      <!-- END Sidebar Header -->

      <!-- Main Navigation -->
      <div class="w-full grow space-y-1.5 overflow-auto p-4">
        <a
          href="javascript:void(0)"
          class="group flex items-center gap-3 rounded-xl border border-transparent bg-slate-100 px-4 py-2.5 font-medium text-slate-900 transition dark:bg-slate-900 dark:text-slate-100"
        >
          <svg
            class="hi-outline hi-home inline-block h-6 w-6 text-sky-600 transition"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
            />
          </svg>
          <span class="grow">Home</span>
          <span class="text-sky-500">&bull;</span>
        </a>
        <a
          href="javascript:void(0)"
          class="group flex items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-medium text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100"
        >
          <svg
            class="hi-outline hi-hashtag inline-block h-6 w-6 text-slate-700 transition group-hover:text-sky-600 dark:text-slate-200"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"
            />
          </svg>
          <span>Explore</span>
        </a>
        <a
          href="javascript:void(0)"
          class="group flex items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-medium text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100"
        >
          <svg
            class="hi-outline hi-bell inline-block h-6 w-6 text-slate-700 transition group-hover:text-sky-600 dark:text-slate-200"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
            />
          </svg>
          <span class="grow">Notifications</span>
        </a>
        <a
          href="javascript:void(0)"
          class="group flex items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-medium text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100"
        >
          <svg
            class="hi-outline hi-mail inline-block h-6 w-6 text-slate-700 transition group-hover:text-sky-600 dark:text-slate-200"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
            />
          </svg>
          <span class="grow">Messages</span>
        </a>
        <a
          href="javascript:void(0)"
          class="group flex items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-medium text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100"
        >
          <svg
            class="hi-outline hi-bookmark inline-block h-6 w-6 text-slate-700 transition group-hover:text-sky-600 dark:text-slate-200"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"
            />
          </svg>
          <span class="grow">Bookmarks</span>
        </a>
        <a
          href="javascript:void(0)"
          class="group flex items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-medium text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100"
        >
          <svg
            class="hi-outline hi-document-text inline-block h-6 w-6 text-slate-700 transition group-hover:text-sky-600 dark:text-slate-200"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
            />
          </svg>
          <span class="grow">Lists</span>
        </a>
        <a
          href="javascript:void(0)"
          class="group flex items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-medium text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100"
        >
          <svg
            class="hi-outline hi-user-circle inline-block h-6 w-6 text-slate-700 transition group-hover:text-sky-600 dark:text-slate-200"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
          <span class="grow">Profile</span>
        </a>
        <a
          href="javascript:void(0)"
          class="group flex items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-medium text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100"
        >
          <svg
            class="hi-outline hi-dots-circle-horizontal inline-block h-6 w-6 text-slate-700 transition group-hover:text-sky-600 dark:text-slate-200"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
          <span class="grow">More</span>
        </a>
      </div>
      <!-- END Main Navigation -->

      <!-- Sub Navigation -->
      <div class="w-full flex-none space-y-3 p-4">
        <a
          href="javascript:void(0)"
          class="group flex items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-semibold text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100"
        >
          <img
            src="https://images.unsplash.com/photo-1528892952291-009c663ce843?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=160&ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTY2ODc1OTQ0OQ&ixlib=rb-4.0.3&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=160"
            alt="User Avatar"
            class="inline-block h-10 w-10 rounded-full"
          />
          <div class="grow leading-5">
            <span class="text-sm">John Smith</span>
            <span class="text-xs font-medium opacity-75"
              >@john.smith256</span
            >
          </div>
          <svg
            class="hi-solid hi-dots-horizontal inline-block h-5 w-5"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"
            />
          </svg>
        </a>
      </div>
      <!-- END Sub Navigation -->
    </nav>
    <!-- Page Sidebar -->

    <!-- Page Header -->
    <header
      id="page-header"
      class="fixed end-0 start-0 top-0 z-30 flex h-20 flex-none items-center bg-white shadow-sm dark:bg-slate-800 lg:hidden"
    >
      <div
        class="container mx-auto flex justify-between px-4 lg:px-8 xl:max-w-5xl"
      >
        <!-- Left Section -->
        <div class="flex items-center gap-2">
          <!-- Toggle Sidebar on Mobile -->
          <button
            type="button"
            class="inline-flex items-center justify-center gap-2 rounded border border-slate-300 bg-white px-2 py-1.5 font-semibold leading-6 text-slate-800 shadow-sm hover:border-slate-300 hover:bg-slate-100 hover:text-slate-800 hover:shadow focus:outline-none focus:ring focus:ring-slate-500/25 active:border-white active:bg-white active:shadow-none dark:border-slate-700/75 dark:bg-slate-900 dark:text-slate-200 dark:hover:border-slate-700 dark:hover:bg-slate-800 dark:hover:text-slate-200 dark:focus:ring-slate-700 dark:active:border-slate-900 dark:active:bg-slate-900"
            x-on:click="mobileSidebarOpen = true"
          >
            <svg
              class="hi-solid hi-menu-alt-1 inline-block h-5 w-5"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
          <!-- END Toggle Sidebar on Mobile -->
        </div>
        <!-- END Left Section -->

        <!-- Middle Section -->
        <div class="flex items-center gap-2">
          <!-- Brand -->
          <a
            href="javascript:void(0)"
            class="inline-flex items-center gap-2 text-lg font-bold tracking-wide text-slate-800 transition hover:opacity-75 active:opacity-100 dark:text-slate-100"
          >
            <svg
              class="hi-mini hi-bolt inline h-5 w-5 text-sky-500"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                d="M11.983 1.907a.75.75 0 00-1.292-.657l-8.5 9.5A.75.75 0 002.75 12h6.572l-1.305 6.093a.75.75 0 001.292.657l8.5-9.5A.75.75 0 0017.25 8h-6.572l1.305-6.093z"
              />
            </svg>
            <span
              >Tail<span class="font-medium text-sky-600 dark:text-sky-500"
                >Social</span
              ></span
            >
          </a>
          <!-- END Brand -->
        </div>
        <!-- END Middle Section -->

        <!-- Right Section -->
        <div class="flex items-center gap-2">
          <!-- Settings -->
          <a
            href="javascript:void(0)"
            class="inline-flex items-center justify-center gap-2 rounded border border-slate-300 bg-white px-2 py-1.5 font-semibold leading-6 text-slate-800 shadow-sm hover:border-slate-300 hover:bg-slate-100 hover:text-slate-800 hover:shadow focus:outline-none focus:ring focus:ring-slate-500/25 active:border-white active:bg-white active:shadow-none dark:border-slate-700/75 dark:bg-slate-900 dark:text-slate-200 dark:hover:border-slate-700 dark:hover:bg-slate-800 dark:hover:text-slate-200 dark:focus:ring-slate-700 dark:active:border-slate-900 dark:active:bg-slate-900"
          >
            <svg
              class="hi-solid hi-user-circle inline-block h-5 w-5"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                clip-rule="evenodd"
              />
            </svg>
          </a>
          <!-- END Toggle Sidebar on Mobile -->
        </div>
        <!-- END Right Section -->
      </div>
    </header>
    <!-- END Page Header -->

    <!-- Page Content -->
    <main
      id="page-content"
      class="flex max-w-full flex-auto flex-col pt-20 lg:pt-0"
    >
      <!-- Page Section -->
      <div
        class="container mx-auto grid grid-cols-1 p-4 lg:grid-cols-12 lg:gap-8 lg:p-8 xl:max-w-5xl"
      >
        <!-- Main Content -->
        <div class="lg:col-span-8">
          <!-- Search (on mobile) -->
          <form onsubmit="return false;" class="mb-4 lg:hidden">
            <div class="relative">
              <div
                class="pointer-events-none absolute inset-y-0 start-0 my-px ms-px flex w-12 items-center justify-center rounded-l text-slate-500"
              >
                <svg
                  class="hi-solid hi-search inline-block h-5 w-5"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <input
                class="block w-full rounded-xl border-0 bg-slate-200/50 py-3 pe-5 ps-12 leading-6 focus:border-sky-500 focus:ring focus:ring-sky-500/50 dark:bg-slate-800/50 dark:placeholder:text-slate-500"
                type="text"
                id="search-mobile"
                name="search-mobile"
                placeholder="Search everything.."
              />
            </div>
          </form>
          <!-- END Search (on mobile) -->

          <!-- Post Update -->
          <div
            class="mb-4 rounded-xl bg-white px-3 py-4 shadow-xl shadow-slate-300/10 dark:bg-slate-700/50 dark:shadow-slate-900 sm:p-6"
          >
            <form onsubmit="return false;">
              <div class="flex gap-4">
                <div class="h-12 w-12 flex-none">
                  <div class="aspect-h-1 aspect-w-1">
                    <img
                      src="https://images.unsplash.com/photo-1528892952291-009c663ce843?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=160&ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTY2ODc1OTQ0OQ&ixlib=rb-4.0.3&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=160"
                      alt="User Avatar"
                      class="inline-block rounded-full"
                    />
                  </div>
                </div>
                <div class="grow">
                  <textarea
                    class="block min-h-[40px] w-full rounded border border-transparent bg-transparent p-0 placeholder:text-slate-400 focus:border-transparent focus:ring-0"
                    id="update"
                    name="update"
                    rows="2"
                    placeholder="What's happening?"
                  ></textarea>
                  <hr class="my-3 border-slate-100 dark:border-slate-700" />
                  <div
                    class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between sm:gap-0"
                  >
                    <div class="flex gap-3">
                      <button
                        type="button"
                        class="text-sky-500 transition hover:text-sky-500 active:text-sky-600"
                      >
                        <svg
                          class="hi-outline hi-photograph inline-block h-6 w-6"
                          stroke="currentColor"
                          fill="none"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                          />
                        </svg>
                      </button>
                      <button
                        type="button"
                        class="text-sky-500 transition hover:text-sky-500 active:text-sky-600"
                      >
                        <svg
                          class="hi-outline hi-emoji-happy inline-block h-6 w-6"
                          stroke="currentColor"
                          fill="none"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                          />
                        </svg>
                      </button>
                      <button
                        type="button"
                        class="text-sky-500 transition hover:text-sky-500 active:text-sky-600"
                      >
                        <svg
                          class="hi-outline hi-calendar inline-block h-6 w-6"
                          stroke="currentColor"
                          fill="none"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                          />
                        </svg>
                      </button>
                      <button
                        type="button"
                        class="text-sky-500 transition hover:text-sky-500 active:text-sky-600"
                      >
                        <svg
                          class="hi-outline hi-document-text inline-block h-6 w-6"
                          stroke="currentColor"
                          fill="none"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                          />
                        </svg>
                      </button>
                      <button
                        type="button"
                        class="text-sky-500 transition hover:text-sky-500 active:text-sky-600"
                      >
                        <svg
                          class="hi-outline hi-dots-circle-horizontal inline-block h-6 w-6"
                          stroke="currentColor"
                          fill="none"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                          />
                        </svg>
                      </button>
                    </div>
                    <button
                      type="submit"
                      class="inline-flex items-center justify-center gap-2 rounded-3xl border border-sky-100 bg-sky-100 px-3 py-2 text-sm font-semibold leading-5 text-sky-700 hover:border-sky-200 hover:bg-sky-200 hover:text-sky-900 focus:outline-none focus:ring focus:ring-sky-500/10 active:border-sky-100 active:bg-sky-100 dark:border-sky-700 dark:bg-sky-700 dark:text-white dark:hover:border-sky-700 dark:hover:bg-sky-600 dark:active:border-sky-700 dark:active:bg-sky-700"
                    >
                      Post Update
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- END Post Update -->

          <!-- Updates -->
          <div
            class="divide-y divide-slate-100 overflow-hidden rounded-xl bg-white shadow-xl shadow-slate-300/10 dark:divide-slate-700 dark:bg-slate-700/50 dark:shadow-slate-900"
          >


            <!-- Update #3 -->
            <?php foreach ($articles as $article) : ?>
            <div
              class="flex gap-2 px-3 pb-2 pt-4 hover:bg-slate-50 dark:hover:bg-slate-700/25 sm:gap-4 sm:px-6"
            >
              <div class="h-12 w-12 flex-none">
                <div class="aspect-h-1 aspect-w-1">
                  <img
                    src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=160&ixid=MXwxfDB8MXxhbGx8fHx8fHx8fA&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=160"
                    alt="User Avatar"
                    class="inline-block rounded-full"
                  />
                </div>
              </div>
              <div class="grow space-y-2">
                <h4
                  class="mb-1 flex flex-col text-sm font-semibold sm:flex-row sm:items-center sm:gap-1"
                >
                  <span class="flex items-center gap-1">
                    <a href="javascript:void(0)" class="hover:underline"
                      ><?= $article['author_name']?></a
                    >
                    <svg
                      class="hi-solid hi-badge-check inline-block h-5 w-5 text-sky-500"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </span>
                  <span>
                    <span class="font-medium text-slate-500"
                      >&bull; <?= $article['created_at']?></span
                    >
                  </span>
                </h4>
                <h3><?= $article['title']?></h3>
                <div class="text-sm"> Category : <span class="text-sm text-slate-700 dark:text-slate-400"><?= $article['category_name']?></span></div>
                <p class="text-sm text-slate-700 dark:text-slate-400">
                  <?= $article['content']?>
                </p>
                <div class="-ms-2 grid grid-cols-4">
                  <div>
                    <button
                      type="button"
                      class="group flex items-center gap-1 text-sm font-semibold text-slate-400 transition hover:text-sky-500"
                    >
                      <span
                        class="inline-flex h-10 w-6 items-center justify-center rounded-full group-hover:bg-sky-100 group-active:bg-sky-50 sm:w-10"
                      >
                        <svg
                          class="hi-outline hi-chat-alt inline-block h-6 w-6"
                          stroke="currentColor"
                          fill="none"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                          />
                        </svg>
                      </span>
                      <span>3</span>
                    </button>
                  </div>
                  <div>
                    <button
                      type="button"
                      class="group flex items-center gap-1 text-sm font-semibold text-slate-400 transition hover:text-emerald-500"
                    >
                      <span
                        class="inline-flex h-10 w-6 items-center justify-center rounded-full group-hover:bg-emerald-100 group-active:bg-emerald-50 sm:w-10"
                      >
                        <svg
                          class="hi-outline hi-refresh inline-block h-6 w-6"
                          stroke="currentColor"
                          fill="none"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                          />
                        </svg>
                      </span>
                      <span>4</span>
                    </button>
                  </div>
                  <div>
                    <button
                      type="button"
                      class="group flex items-center gap-1 text-sm font-semibold text-slate-400 transition hover:text-rose-500"
                    >
                      <span
                        class="inline-flex h-10 w-6 items-center justify-center rounded-full group-hover:bg-rose-100 group-active:bg-rose-50 sm:w-10"
                      >
                        <svg
                          class="hi-outline hi-heart inline-block h-6 w-6"
                          stroke="currentColor"
                          fill="none"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                          />
                        </svg>
                      </span>
                      <span>15</span>
                    </button>
                  </div>
                  <div>
                    <button
                      type="button"
                      class="group flex items-center gap-1 text-sm font-semibold text-slate-400 transition hover:text-sky-500"
                    >
                      <span
                        class="inline-flex h-10 w-6 items-center justify-center rounded-full group-hover:bg-sky-100 group-active:bg-sky-50 sm:w-10"
                      >
                        <svg
                          class="hi-outline hi-share inline-block h-6 w-6"
                          stroke="currentColor"
                          fill="none"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"
                          />
                        </svg>
                      </span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach;?>
            <!-- END Update #3 -->
          </div>
          <!-- END Updates -->
        </div>
        <!-- END Main Content -->

        <!-- Extra -->
        <div class="hidden space-y-4 lg:col-span-4 lg:block">
          <!-- Search -->
          <form onsubmit="return false;">
            <div class="relative">
              <div
                class="pointer-events-none absolute inset-y-0 start-0 my-px ms-px flex w-12 items-center justify-center rounded-l text-slate-500"
              >
                <svg
                  class="hi-solid hi-search inline-block h-5 w-5"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <input
                class="block w-full rounded-xl border-0 bg-slate-200/50 py-3 pe-5 ps-12 leading-6 focus:border-sky-500 focus:ring focus:ring-sky-500/50 dark:bg-slate-800/50 dark:placeholder:text-slate-500"
                type="text"
                id="search"
                name="search"
                placeholder="Search everything.."
              />
            </div>
          </form>
          <!-- END Search -->

          <!-- Relevant People -->
          <div
            class="space-y-2 rounded-xl bg-slate-200/50 py-4 dark:bg-slate-800/50"
          >
            <h2 class="px-4 text-lg font-bold">Relevant people</h2>
            <nav>
              <a
                class="flex items-center gap-3 px-4 py-2 hover:bg-slate-300/40 active:bg-transparent dark:hover:bg-slate-700/40"
                href="javascript:void(0)"
              >
                <div class="h-12 w-12 flex-none">
                  <div class="aspect-h-1 aspect-w-1">
                    <img
                      src="https://images.unsplash.com/photo-1567186937675-a5131c8a89ea?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=160&ixid=MXwxfDB8MXxhbGx8fHx8fHx8fA&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=160"
                      alt="User Avatar"
                      class="inline-block rounded-full border-2 border-white"
                    />
                  </div>
                </div>
                <div class="grow space-y-1">
                  <h4 class="flex items-center gap-1 text-sm font-semibold">
                    <span>Rey Mackinley</span>
                    <svg
                      class="hi-solid hi-badge-check inline-block h-5 w-5 text-sky-500"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </h4>
                  <h5 class="text-xs font-medium text-slate-500">
                    @rey_mackinley005
                  </h5>
                </div>
              </a>
              <a
                class="flex items-center gap-3 px-4 py-2 hover:bg-slate-300/40 active:bg-transparent dark:hover:bg-slate-700/40"
                href="javascript:void(0)"
              >
                <div class="h-12 w-12 flex-none">
                  <div class="aspect-h-1 aspect-w-1">
                    <img
                      src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=160&ixid=MXwxfDB8MXxhbGx8fHx8fHx8fA&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=160"
                      alt="User Avatar"
                      class="inline-block rounded-full border-2 border-white"
                    />
                  </div>
                </div>
                <div class="grow space-y-1">
                  <h4 class="flex items-center gap-1 text-sm font-semibold">
                    <span>Kate Taylor</span>
                    <svg
                      class="hi-solid hi-badge-check inline-block h-5 w-5 text-sky-500"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </h4>
                  <h5 class="text-xs font-medium text-slate-500">
                    @kateTaylor302
                  </h5>
                </div>
              </a>
            </nav>
          </div>
          <!-- END Relevant People -->

          <!-- Trends -->
          <div
            class="space-y-2 rounded-xl bg-slate-200/50 py-4 dark:bg-slate-800/50"
          >
            <h2 class="px-4 text-lg font-bold">Trends for you</h2>
            <nav>
              <a
                class="block space-y-1 px-4 py-2 hover:bg-slate-300/40 active:bg-transparent dark:hover:bg-slate-700/40"
                href="javascript:void(0)"
              >
                <div class="text-xs font-medium text-slate-500">
                  Trending in your location
                </div>
                <div class="text-sm font-semibold">#webdesign</div>
                <div class="text-xs font-medium text-slate-500">
                  20k updates
                </div>
              </a>
              <a
                class="block space-y-1 px-4 py-2 hover:bg-slate-300/40 active:bg-transparent dark:hover:bg-slate-700/40"
                href="javascript:void(0)"
              >
                <div class="text-xs font-medium text-slate-500">
                  Trending in your location
                </div>
                <div class="text-sm font-semibold">#webdev</div>
                <div class="text-xs font-medium text-slate-500">
                  5k updates
                </div>
              </a>
              <a
                class="block space-y-1 px-4 py-2 hover:bg-slate-300/40 active:bg-transparent dark:hover:bg-slate-700/40"
                href="javascript:void(0)"
              >
                <div class="text-xs font-medium text-slate-500">
                  Trending
                </div>
                <div class="text-sm font-semibold">#tailwindcss</div>
                <div class="text-xs font-medium text-slate-500">
                  4,6k updates
                </div>
              </a>
              <a
                class="block space-y-1 px-4 py-2 hover:bg-slate-300/40 active:bg-transparent dark:hover:bg-slate-700/40"
                href="javascript:void(0)"
              >
                <div class="text-xs font-medium text-slate-500">
                  Trending
                </div>
                <div class="text-sm font-semibold">#laravel</div>
                <div class="text-xs font-medium text-slate-500">
                  12,9k updates
                </div>
              </a>
              <a
                class="block space-y-1 px-4 py-2 hover:bg-slate-300/40 active:bg-transparent dark:hover:bg-slate-700/40"
                href="javascript:void(0)"
              >
                <div class="text-xs font-medium text-slate-500">
                  Trending
                </div>
                <div class="text-sm font-semibold">#digitalNomads</div>
                <div class="text-xs font-medium text-slate-500">
                  7,8k updates
                </div>
              </a>
              <a
                class="block space-y-1 px-4 py-2 hover:bg-slate-300/40 active:bg-transparent dark:hover:bg-slate-700/40"
                href="javascript:void(0)"
              >
                <div class="text-xs font-medium text-slate-500">
                  Trending
                </div>
                <div class="text-sm font-semibold">#coffee</div>
                <div class="text-xs font-medium text-slate-500">
                  35k updates
                </div>
              </a>
            </nav>
          </div>
          <!-- END Trends -->

          <!-- Page Footer -->
          <footer
            id="page-footer"
            class="space-y-2 rounded-xl bg-slate-200/50 p-4 dark:bg-slate-800/50"
          >
            <div
              class="space-y-2 text-sm font-medium text-slate-600 dark:text-slate-500"
            >
              <div>© <span class="font-semibold">TailSocial</span></div>
              <div class="inline-flex items-center justify-center">
                <span>Crafted with</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                  class="mx-0.5 h-4 w-4 text-red-600"
                >
                  <path
                    d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z"
                  ></path>
                </svg>
                <span
                  >by
                  <a
                    class="font-medium text-sky-600 transition hover:text-sky-700 hover:underline"
                    href="https://pixelcave.com"
                    target="_blank"
                    >pixelcave</a
                  ></span
                >
              </div>
            </div>
          </footer>
          <!-- END Page Footer -->
        </div>
        <!-- END Extra -->
      </div>
      <!-- END Page Section -->
    </main>
    <!-- END Page Content -->
  </div>
  <!-- END Page Container -->
</div>
</body>

</html>