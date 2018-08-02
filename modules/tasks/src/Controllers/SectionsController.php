<?php

namespace SON\Framework\Tasks\Controllers;

use SON\Framework\CrudController;

class SectionsController extends CrudController
{
    protected function getModel(): string
    {
        return 'sections_model';
    }

    public function listByProject($c, $request)
    {
        $id = $request->query->get('id');
        return $c['sections_model']->all(['project_id' => $id]);
    }
}
