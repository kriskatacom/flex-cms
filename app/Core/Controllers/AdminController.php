<?php

namespace Flex\Core\Controllers;

use Flex\Core\Auth;
use Flex\Core\Controllers\BaseController;
use Flex\Core\Routing\View;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (!Auth::check() || !Auth::isAdmin()) {
            View::redirect('/admin');
        }
    }

    public function index()
    {
        $this->render(View::make('admin/dashboard', [], 'admin'));
    }
}