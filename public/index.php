<?php

session_start();

require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Model.php';
require_once __DIR__ . '/../app/Core/Controller.php';
require_once __DIR__ . '/../app/Core/Auth.php';
require_once __DIR__ . '/../app/Core/FileUploader.php';

foreach (glob(__DIR__ . '/../app/Models/*.php') as $file) {
    require_once $file;
}

foreach (glob(__DIR__ . '/../app/Controllers/*.php') as $file) {
    require_once $file;
}

$route = $_GET['route'] ?? (Auth::check() ? 'dashboard' : 'login');

$routes = [
    'login' => [
        AuthController::class,
        'login'
    ],

    'logout' => [
        AuthController::class,
        'logout'
    ],

    'dashboard' => [
        DashboardController::class,
        'index'
    ],

    'students' => [
        StudentController::class,
        'index'
    ],

    'students.store' => [
        StudentController::class,
        'store'
    ],

    'students.update' => [
        StudentController::class,
        'update'
    ],

    'students.delete' => [
        StudentController::class,
        'delete'
    ],

    'services' => [
        ServiceController::class,
        'index'
    ],

    'services.store' => [
        ServiceController::class,
        'store'
    ],

    'services.update' => [
        ServiceController::class,
        'update'
    ],

    'services.delete' => [
        ServiceController::class,
        'delete'
    ],

    'bookings' => [
        BookingController::class,
        'index'
    ],

    'bookings.store' => [
        BookingController::class,
        'store'
    ],

    'bookings.status' => [
        BookingController::class,
        'updateStatus'
    ],

    'bookings.delete' => [
        BookingController::class,
        'delete'
    ],

    'presence' => [
        PresenceController::class,
        'index'
    ],

    'presence.store' => [
        PresenceController::class,
        'store'
    ],

    'presence.delete' => [
        PresenceController::class,
        'delete'
    ],

    'api.stats' => [
        ApiController::class,
        'stats'
    ],

    'api.students' => [
        ApiController::class,
        'students'
    ],
];

if (!isset($routes[$route])) {
    http_response_code(404);
    exit('404 Route not found');
}

[$class, $method] = $routes[$route];

(new $class())->$method();