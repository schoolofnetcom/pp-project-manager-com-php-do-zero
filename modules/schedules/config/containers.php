<?php

$container['schedules_model'] = function ($c) {
    $id = $c['loggedUser']['user']->id;
    $schedules = new \SON\Framework\Schedules\Models\Schedules($c);
    $schedules->user_id = $id;

    return $schedules;
};
