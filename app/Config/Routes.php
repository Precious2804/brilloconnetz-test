<?php

use App\Controllers\AuthController;
use App\Controllers\MainController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('register', [AuthController::class, 'register']);
$routes->post('register/submit', [AuthController::class, 'submitRegister']);
$routes->get('verify', [AuthController::class, 'verify']);
$routes->get('login', [AuthController::class, 'login']);
$routes->post('login/submit', [AuthController::class, 'submitLogin']);
$routes->get('forgot', [AuthController::class, 'forgot']);
$routes->post('forgot/submit', [AuthController::class, 'requestPassReset']);
$routes->get('reset-password', [AuthController::class, 'resetPassword']);
$routes->post('reset/submit', [AuthController::class, 'submitResetPassword']);

$routes->get('dashboard', [MainController::class, 'dashboard']);
