<?php

namespace Flex\Core\Controllers;

use Flex\Core\Routing\View;
use Flex\Models\User;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        $this->render(View::make('admin/users/index', [
            'title' => 'Потребители',
            'users' => $users,
            'primaryButton' => [
                'label' => 'Нов потребител',
                'url' => '/admin/users/create',
                'icon' => 'fa-plus'
            ]
        ], 'admin'));
    }
}