<?php

namespace App\Controllers;

use SON\Framework\Exceptions\HttpException;
use Firebase\JWT\JWT;

class UsersController
{
    public function register($c, $request)
    {
        return $c['users_model']->create($request->request->all());
    }

    public function getToken($c, $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $user = $c['users_model']->getByEmail($email);
        if (!$user) {
            throw new HttpException("Forbidden", 401);
        }

        if (!password_verify($password, $user['password'])) {
            throw new HttpException("Forbidden", 401);
        }

        unset($user['password']);

        $key = 'SECRET KEY';
        $data = [
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24 * 360),
            'user' => $user
        ];

        $token = JWT::encode($data, $key);
        return ['token' => $token];
    }

    public function getCurrentUser($c)
    {
        $token = getallheaders()['Authorization'] ?? null;

        if (!$token) {
            $token = filter_input(\INPUT_GET, 'token');
        }

        if (!$token) {
            throw new HttpException("Forbidden", 401);
        }

        try {
            $key = 'SECRET KEY';
            $data = JWT::decode($token, $key, ['HS256']);
        } catch(\Exception $e) {
            throw new HttpException("Forbidden", 401);
        }

        return (array)$data;
    }
}
