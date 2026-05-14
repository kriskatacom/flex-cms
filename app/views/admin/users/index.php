<?php

use Flex\Core\UI\Table;

$currentTab = $_GET['tab'] ?? 'users';

$tabs = [
    'users' => 'Потребители',
    'roles' => 'Роли',
    'permissions' => 'Разрешения'
];

Table::tabs($tabs, $currentTab);

$users = $users ?? [];
$roles = $roles ?? [];
$permissions = $permissions ?? [];

if ($currentTab === 'users'): ?>

    <?php Table::header(slot: function () use ($roles) { ?>
        <?php Table::search('Търсене на потребител...'); ?>

        <?php
        $roleOptions = ['' => 'Всички роли'];

        if (!empty($roles)) {
            foreach ($roles as $role) {
                $roleOptions[$role->slug] = $role->name;
            }
        }
        Table::select('role', $roleOptions);
        ?>

        <?php Table::submit('Приложи'); ?>
        <?php Table::reset('/admin/users'); ?>
    <?php }); ?>

    <?php
    Table::create($users)
        ->column('Потребител', fn($user) => $user->username ?? '---', 'username')
        ->column('Имейл', fn($user) => $user->email ?? '---', 'email')
        ->column('Роля', function ($user) {
            $roles = $user->roles;

            return ($roles->isNotEmpty())
                ? $roles->first()->name
                : '<span class="text-slate-400">Няма</span>';
        }, 'role')
        ->render('mt-5');
    ?>

<?php elseif ($currentTab === 'roles'): ?>
    <?php
    Table::create($roles)
        ->column('Име на роля', fn($role) => $role->name ?? '---')
        ->column('Slug', fn($role) => isset($role->slug) ? "<code class='bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded text-xs'>{$role->slug}</code>" : '---')
        ->column('Описание', fn($role) => $role->description ?? '-')
        ->column('Действия', fn($role) => isset($role->id) ? "
            <div class='flex gap-3'>
                <a href='/admin/roles/edit/{$role->id}' class='text-indigo-500 hover:text-indigo-700'><i class='fa-solid fa-pen-to-square'></i></a>
                <button class='text-rose-500 hover:text-rose-700'><i class='fa-solid fa-trash'></i></button>
            </div>
        " : "")
        ->render('mt-5');
    ?>

<?php elseif ($currentTab === 'permissions'): ?>

    <?php Table::header(slot: function () { ?>
        <p class="text-sm text-slate-500">Списък с наличните системни разрешения</p>
    <?php }); ?>

    <?php
    Table::create($permissions)
        ->column('Модул', fn($p) => "<strong>" . strtoupper($p->module ?? 'Система') . "</strong>")
        ->column('Име на разрешение', fn($p) => $p->name ?? '---')
        ->column('Ключ (Slug)', fn($p) => isset($p->slug) ? "<span class='text-emerald-600 dark:text-emerald-400'>{$p->slug}</span>" : '---')
        ->render('mt-5');
    ?>

<?php endif; ?>