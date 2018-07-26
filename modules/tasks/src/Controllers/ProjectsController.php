<?php

namespace SON\Framework\Tasks\Controllers;

use SON\Framework\CrudController;

class ProjectsController extends CrudController
{
    protected function getModel(): string
    {
        return 'projects_model';
    }
}
