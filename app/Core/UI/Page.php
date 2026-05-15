<?php

namespace Flex\Core\UI;

class Page
{
    public static function header(string $title, string|null $backUrl = null, string|null $subtitle = null): void
    {
        ?>
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <?php if ($backUrl): ?>
                        <a href="<?= $backUrl ?>" 
                           class="flex items-center justify-center w-9 h-9 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors text-slate-500">
                            <i class="fa-solid fa-arrow-left text-sm"></i>
                        </a>
                    <?php endif; ?>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white"><?= $title ?></h1>
                </div>
                <?php if ($subtitle): ?>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400 ml-12"><?= $subtitle ?></p>
                <?php endif; ?>
            </div>

            <div class="flex items-center gap-3">
                <?php if ($backUrl): ?>
                    <span class="text-xs text-slate-400 hidden md:block">Натиснете <kbd class="px-1.5 py-0.5 rounded border border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-700 font-sans">Esc</kbd> за отказ</span>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}