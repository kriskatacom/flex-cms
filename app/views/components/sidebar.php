<?php

define('SIDEBAR_LINKS', [
    ['url' => '/admin/dashboard', 'icon' => 'fa-chart-line', 'label' => 'Табло'],
    ['url' => '/admin/users', 'icon' => 'fa-users', 'label' => 'Потребители'],
    ['url' => '/admin/pages', 'icon' => 'fa-book-open', 'label' => 'Страници'],
]);
?>

<div x-data="sidebar('admin-sidebar', <?= $is_open ? 'true' : 'false' ?>)">
    <div id="sidebar-backdrop" x-show="isOpen" x-cloak @click="toggle()"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden">
    </div>

    <aside id="main-sidebar" :class="isOpen ? 'translate-x-0' : '-translate-x-full'"
        class="min-h-screen fixed overflow-auto inset-y-0 left-0 w-10/12 md:w-80 bg-black text-white z-50 transform shadow-2xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0">

        <div class="p-5 flex items-center justify-between">
            <div class="flex flex-col justify-center items-center mx-auto">
                <span class="text-xl md:text-2xl font-black uppercase text-secondary">Администрация</span>
                <span class="text-sm text-gray-400">Flex CMS</span>
            </div>
            <button @click="toggle()"
                class="lg:hidden fixed top-5 right-5 flex justify-center items-center rounded-md w-12 h-12 bg-gray-800 hover:bg-gray-900 text-slate-400">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <hr class="border-t border-gray-800" />

        <nav class="space-y-2 flex-1 text-lg">
            <?php $current_admin_page = $_SERVER['REQUEST_URI']; ?>

            <div class="p-2 space-y-2">
                <?php foreach (SIDEBAR_LINKS as $link): ?>
                    <?php $is_active = str_starts_with($current_admin_page, $link['url']); ?>

                    <a href="<?= $link['url'] ?>" @click.prevent="navigateTo('<?= $link['url'] ?>')"
                        :class="linkClasses(<?= $is_active ? 'true' : 'false' ?>)">
                        <i class="fa-solid <?= $link['icon'] ?> text-xl w-5"></i>
                        <?= $link['label'] ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <hr class="border-t border-gray-800" />

            <div class="p-2">
                <form action="/users/logout" method="POST" id="logout-form">
                    <button type="submit" :class="logoutClasses()">
                        <i class="fa-solid fa-power-off w-5 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Изход</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>
</div>
