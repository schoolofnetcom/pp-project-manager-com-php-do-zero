<?php

namespace SON\Framework;

use SON\Framework\Exceptions\HttpException;

class Router
{
    private $routes = [];

    public function add(STRING $method, string $pattern, $callback)
    {
        $method = strtolower($method);
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        $this->routes[$method][$pattern] = $callback;
    }

    public function run()
    {
        $url = $this->getCurrentUrl();
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if (empty($this->routes[$method])) {
            throw new HttpException('Page not found', 404);
        }

        foreach ($this->routes[$method] as $route => $action) {
            if (preg_match($route, $url, $params)) {
                return compact('action', 'params');
            }
        }

        throw new HttpException('Page not found', 404);
    }

    public function getCurrentUrl()
    {
        $url = $_SERVER['PATH_INFO'] ?? '/';

        if (strlen($url) > 1) {
            $url = rtrim($url, '/');
        }

        return $url;
    }
}
