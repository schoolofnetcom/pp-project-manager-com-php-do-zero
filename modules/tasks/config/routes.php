<?php

$router->add('GET', '/api/projects', 'SON\Framework\Tasks\Controllers\ProjectsController::index');
$router->add('POST', '/api/projects', 'SON\Framework\Tasks\Controllers\ProjectsController::create');

$router->add('GET', '/api/sections', 'SON\Framework\Tasks\Controllers\SectionsController::listByProject');
$router->add('POST', '/api/sections', 'SON\Framework\Tasks\Controllers\SectionsController::create');

$router->add('GET', '/api/tasks', 'SON\Framework\Tasks\Controllers\Taskscontroller::listByProject');
$router->add('POST', '/api/tasks', 'SON\Framework\Tasks\Controllers\Taskscontroller::create');

$router->add('GET', '/api/subtasks', 'SON\Framework\Tasks\Controllers\SubTasksController::listByTask');
$router->add('POST', '/api/subtasks', 'SON\Framework\Tasks\Controllers\SubTasksController::create');
$router->add('PUT', '/api/subtasks/(\d+)', 'SON\Framework\Tasks\Controllers\SubTasksController::update');
