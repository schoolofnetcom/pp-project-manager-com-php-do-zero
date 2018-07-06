<?php

namespace SON\Framework;

use App\Models\Users;

abstract class CrudController
{
    abstract protected function getModel(): string;

    public function index($c, $request)
    {
        return $c[$this->getModel()]->all();
    }

    public function show($c, $request)
    {
        $id = $request->attributes->get(1);
        return $c[$this->getModel()]->get(['id' => $id]);
    }

    public function create($c, $request)
    {
        return $c[$this->getModel()]->create($request->request->all());
    }

    public function update($c, $request)
    {
        $id = $request->attributes->get(1);
        return $c[$this->getModel()]->update(['id' => $id], $request->request->all());
    }

    public function delete($c, $request)
    {
        $id = $request->attributes->get(1);
        return $c[$this->getModel()]->delete(['id' => $id]);
    }
}
