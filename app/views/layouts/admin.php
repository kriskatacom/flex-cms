<?php

use Flex\Core\Vite;
use Flex\Core\Routing\View;

$sidebarOpen = $_SESSION['sidebar_open'] ?? true;
?>

<!DOCTYPE html>
<html lang="bg" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?? 'Администрация | Flex CMS'; ?>
    </title>

    <?= Vite::use('admin') ?>
</head>

<body class="bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-100 min-h-screen font-sans">

    <div class="flex min-h-screen overflow-hidden">

        <?php View::component('sidebar', ['is_open' => $sidebarOpen]); ?>

        <div class="flex-1 flex flex-col min-w-0 bg-slate-50 dark:bg-slate-900">

            <header
                class="h-16 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between px-4 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="$dispatch('toggle-sidebar')"
                        class="lg:hidden p-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>

                    <h1 class="text-lg font-semibold truncate">
                        <?= $title ?? 'Табло'; ?>
                    </h1>
                </div>

                <div class="flex items-center gap-2">
                    <button @click="darkMode = !darkMode"
                        class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-500">
                        <i class="fa-solid" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
                    </button>

                    <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-2"></div>

                    <div class="flex items-center gap-3 pl-2">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-medium leading-none">Администратор</p>
                            <p class="text-xs text-slate-500 mt-1">admin@flex-cms.com</p>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">
                            A
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
                <div class="animate-fade-in">
                    <?= $content; ?>
                </div>
            </main>

            <footer
                class="py-4 px-6 bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700 text-sm text-slate-500 flex flex-col sm:flex-row justify-between items-center gap-2">
                <p>&copy;
                    <?= date('Y'); ?> Flex CMS v3.0
                </p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-indigo-600">Документация</a>
                    <a href="#" class="hover:text-indigo-600">Поддръжка</a>
                </div>
            </footer>
        </div>
    </div>

</body>

</html>
