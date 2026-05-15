<?php

global $router;

use Flex\Core\Controllers\AuthController;
use Flex\Core\Controllers\AdminController;
use Flex\Core\Controllers\UserController;
use Flex\Core\Controllers\RoleController;

$routes = [
    // Auth маршрути
    ['GET',  '/admin',                  [AuthController::class, 'showLogin']],
    ['POST', '/admin',                  [AuthController::class, 'login']],
    ['GET',  '/logout',                 [AuthController::class, 'logout']],

    // Dashboard & UI
    ['GET',  '/admin/dashboard',        [AdminController::class, 'index']],
    ['POST', '/admin/sidebar-toggle',   [AdminController::class, 'toggleSidebar']],
    ['POST', '/admin/theme-toggle',     [AdminController::class, 'toggleTheme']],
    ['POST', '/admin/ui/save-state',    [AdminController::class, 'saveUiState']],

    // Users (RBAC)
    ['GET',  '/admin/users',            [UserController::class, 'index']],

    // Roles
    ['GET',  '/admin/roles/create',     [RoleController::class, 'create']],
    ['POST', '/admin/roles/create',     [RoleController::class, 'store']],
    ['GET',  '/admin/roles/edit/{id}',  [RoleController::class, 'edit']],
    ['POST', '/admin/roles/edit/{id}',  [RoleController::class, 'update']],
];

foreach ($routes as [$method, $path, $handler]) {
    $method = strtolower($method);
    $router->$method($path, $handler);
}
