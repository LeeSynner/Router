<?php

namespace Synsei\Router;

class Router
{
    private const GET = "GET";
    private const POST = "POST";
    private const PUT = "PUT";
    private const DELETE = "DELETE";

    private static array $listOfRoutes = [
        self::GET => [],
        self::POST => [],
        self::PUT => [],
        self::DELETE => []
    ];

    public static function Get(string $path, string $controller, string $action): void
    {
        self::$listOfRoutes[self::GET][$path] = new Route($controller, $action);;
    }

    public static function Post(string $path, string $controller, string $action): void
    {
        self::$listOfRoutes[self::POST][$path] = new Route($controller, $action);;
    }

    public static function Put(string $path, string $controller, string $action): void
    {
        self::$listOfRoutes[self::PUT][$path] = new Route($controller, $action);;
    }

    public static function Delete(string $path, string $controller, string $action): void
    {
        self::$listOfRoutes[self::DELETE][$path] = new Route($controller, $action);;
    }

    public static function FindRoute(string $method, string $path): ?Route
    {
        $path = trim(explode("?", $path)[0], "/");
        foreach (self::$listOfRoutes[$method] as $key => $route) {
            if ($path == $key) {
                return $route;
            }
        }
        return null;
    }
}
