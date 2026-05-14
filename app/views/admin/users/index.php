<?php

use Flex\Core\UI\Table;

Table::header(
    slot: function () { ?>
    <?php Table::search('Търсене на потребител...'); ?>

    <?php Table::select('role', [
            '' => 'Всички роли',
            'admin' => 'Админи',
            'editor' => 'Редактори'
        ]); ?>

    <?php Table::submit('Приложи'); ?>
    <?php Table::reset('/admin/users'); ?>
<?php }
);

Table::create($users)
    ->column('Потребител', fn($user) => $user->username, 'username')
    ->column('Имейл', fn($user) => $user->email, 'email')
    ->column('Роля', fn($user) => $user->role, 'role')
    ->render('mt-5');