<?php

namespace SON\Framework\Tasks\Controllers;

use SON\Framework\CrudController;

class SubTasksController extends CrudController
{
    protected function getModel(): string
    {
        return 'subtasks_model';
    }

    public function listByTask($c, $request)
    {
        $id = $request->query->get('id');
        return $c['subtasks_model']->all(['task_id'=>$id]);
    }
}
