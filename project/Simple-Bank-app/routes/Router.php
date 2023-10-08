<?php

class Router
{
    private static array $list = [];
    public static function get(string $page, array $closure) // GET route
    {
        static::$list[] = [
            'page' => $page,
            'method' => 'GET',
            'controller' => $closure[0],
            'action' => $closure[1],
        ];
    }

    public static function post(string $page, array $closure) // POST route
    {
        static::$list[] = [
            'page' => $page,
            'method' => 'POST',
            'controller' => $closure[0],
            'action' => $closure[1],
        ];
    }

    public static function run()
    {

        $method = $_SERVER['REQUEST_METHOD'];
        $request = $_SERVER['REQUEST_URI'];
        $page = explode("?", $request)[0];

        foreach (self::$list as $item) {

            if ($item['page'] === $page && $item['method'] === $method) {
                $newController = new $item['controller']();
                $action = $item['action'];
                $newController->$action();
                return;
            }
        }
        die('Not found');
    }












}
