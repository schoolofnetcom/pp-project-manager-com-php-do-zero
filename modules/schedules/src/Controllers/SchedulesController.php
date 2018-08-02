<?php

namespace SON\Framework\Schedules\Controllers;

use SON\Framework\CrudController;

class SchedulesController extends CrudController
{
    protected function getModel(): string
    {
        return 'schedules_model';
    }
}
