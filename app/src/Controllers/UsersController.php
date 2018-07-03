<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController
{
    public function index($container, $request)
    {
        return '';
    }

    public function show($container, $request)
    {
        $user = new Users($container);
        $user->create(['name' => 'Erik']);
        return $user->get($request->attributes->get(1));
    }

    public function create($container, $request)
    {
        return '';
    }

    public function update($container, $request)
    {
        return '';
    }

    public function delete($container, $request)
    {
        return '';
    }
}
