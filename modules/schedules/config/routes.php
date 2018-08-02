<?php

$router->add('GET', '/api/schedules', 'SON\Framework\Schedules\Controllers\SchedulesController::index');
$router->add('POST', '/api/schedules', 'SON\Framework\Schedules\Controllers\SchedulesController::create');
