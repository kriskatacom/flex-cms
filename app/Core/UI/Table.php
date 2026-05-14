<?php

namespace Flex\Core\UI;

class Table
{
    public static function header(?callable $slot = null): void
    {
        ?>
        <?php if ($slot): ?>
            <div class="dark:border-slate-700">
                <form method="GET" class="flex flex-wrap gap-2">
                    <?php $slot(); ?>
                </form>
            </div>
        <?php endif; ?>
        <?php
    }

    public static function search(string $placeholder = 'Търсене...', string $name = 'search', string $value = ''): void
    {
        ?>
        <div class="relative w-full max-w-full sm:max-w-xs">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="<?= $name ?>" value="<?= htmlspecialchars($value) ?>" placeholder="<?= $placeholder ?>" class="w-full pl-10 pr-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all dark:text-white">
        </div>
        <?php
    }

    public static function select(string $name, array $options, string $selected = ''): void
    {
        ?>
        <select name="<?= $name ?>" class="w-full max-w-full sm:max-w-xs bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all dark:text-white">
            <?php foreach ($options as $value => $label): ?>
                <option value="<?= $value ?>" <?= $value === $selected ? 'selected' : '' ?>>
                    <?= $label ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    public static function submit(string $label = 'Филтрирай', string $icon = 'fa-filter'): void
    {
        ?>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-white hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-medium rounded-md border border-slate-200 dark:border-slate-700 transition-all outline-none focus:ring-2 focus:ring-slate-400">
            <?php if ($icon): ?>
                <i class="fa-solid <?= $icon ?> mr-2"></i>
            <?php endif; ?>
            <?= $label ?>
        </button>
        <?php
    }

    public static function reset(string $url, string $label = 'Изчисти', string $icon = 'fa-rotate-left'): void
    {
        if (empty($_GET)) {
            return;
        }
        
        ?>
        <a 
            href="<?= $url ?>" 
            class="inline-flex items-center px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 text-sm font-medium rounded-lg transition-all outline-none focus:ring-2 focus:ring-slate-400"
        >
            <?php if ($icon): ?>
                <i class="fa-solid <?= $icon ?> mr-2"></i>
            <?php endif; ?>
            <?= $label ?>
        </a>
        <?php
    }
}
