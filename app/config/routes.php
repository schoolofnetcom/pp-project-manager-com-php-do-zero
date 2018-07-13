<?php

$router->add('GET', '/', function () {
    return file_get_contents(__DIR__ . '/../../template/index.html');
});

$router->add('GET', '/users', '\App\Controllers\UsersController::index');
$router->add('GET', '/users/(\d+)', '\App\Controllers\UsersController::show');
$router->add('POST', '/users', '\App\Controllers\UsersController::create');
$router->add('PUT', '/users/(\d+)', '\App\Controllers\UsersController::update');
$router->add('DELETE', '/users/(\d+)', '\App\Controllers\UsersController::delete');
