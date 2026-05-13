<?php

global $router;

use Flex\Core\Controllers\AuthController;
use Flex\Core\Controllers\AdminController;

$router->get('/admin', [AuthController::class, 'showLogin']);
$router->post('/admin', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/admin/dashboard', [AdminController::class, 'index']);