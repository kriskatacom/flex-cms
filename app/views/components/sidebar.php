<?php

define('SIDEBAR_LINKS', [
    ['url' => '/admin/dashboard', 'icon' => 'fa-chart-line', 'label' => 'Табло'],
    ['url' => '/admin/users', 'icon' => 'fa-users', 'label' => 'Потребители'],
    ['url' => '/admin/pages', 'icon' => 'fa-book-open', 'label' => 'Страници'],
]);
?>

<div>
    <div id="sidebar-backdrop" x-show="isOpen" x-cloak @click="toggle()"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden">
    </div>

    <aside id="main-sidebar" :class="{ 
            'translate-x-0': isOpen, 
            '-translate-x-full': !isOpen,
            'transition-transform duration-300': mounted // Анимацията се активира само след зареждане
        }"
        class="min-h-screen fixed inset-y-0 left-0 w-72 bg-black text-white z-50 transform shadow-2xl <?= !$is_open ? '-translate-x-full' : '' ?>">

        <div class="p-5 flex items-center justify-between">
            <div class="flex flex-col justify-center items-center mx-auto text-center">
                <span class="text-xl font-black uppercase text-secondary">Администрация</span>
                <span class="text-sm text-gray-500">Flex CMS</span>
            </div>
            <button @click="toggle()"
                class="lg:hidden flex justify-center items-center rounded-md w-10 h-10 bg-gray-800 hover:bg-gray-900 text-slate-400">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <hr class="border-t border-gray-800" />

        <nav class="space-y-2 flex-1 text-lg">
            <?php $current_admin_page = $_SERVER['REQUEST_URI']; ?>

            <div class="p-2 space-y-1">
                <?php foreach (SIDEBAR_LINKS as $link): ?>
                    <?php $is_active = str_starts_with($current_admin_page, $link['url']); ?>

                    <a href="<?= $link['url'] ?>" @click.prevent="navigateTo('<?= $link['url'] ?>')"
                        class="flex items-center gap-3 px-3 py-2 rounded-md font-semibold"
                        :class="isOpen ? (<?= $is_active ? 'true' : 'false' ?> ? 'bg-primary text-white' : 'text-slate-400 hover:bg-primary hover:text-white') : ''">

                        <i class="fa-solid <?= $link['icon'] ?> text-xl w-6"></i>
                        <span><?= $link['label'] ?></span>
                    </a>
                <?php endforeach; ?>
            </div>

            <hr class="border-t border-gray-800" />

            <div class="p-2">
                <form action="/logout" method="GET">
                    <button type="submit"
                        class="w-full flex items-center gap-3 font-semibold px-3 py-2 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition-all group">
                        <i class="fa-solid fa-power-off w-6 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Изход</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>
</div>
