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
