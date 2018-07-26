<?php

$router->add('GET', '/api/projects', 'SON\Framework\Tasks\Controllers\ProjectsController::index');
$router->add('POST', '/api/projects', 'SON\Framework\Tasks\Controllers\ProjectsController::create');
