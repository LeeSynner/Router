<?php

namespace Libs\Router;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class Router
{
    private static array $listOfRoutes = [
        "GET" => [],
        "POST" => [],
        "PUT" => [],
        "DELETE" => []
    ];

    public static function Get(string $path, string $controller, string $action): void
    {
        self::$listOfRoutes["GET"][$path] = new Route($controller, $action);;
    }

    public static function Post(string $path, string $controller, string $action): void
    {
        self::$listOfRoutes["POST"][$path] = new Route($controller, $action);;
    }

    public static function FindRoute(
        string $method,
        string $path,
        ContainerInterface $diContainer,
        LoggerInterface $logger): void
    {
        $path = trim(explode("?", $path)[0], "/");
        foreach (self::$listOfRoutes[$method] as $key => $route) {
            if ($path == $key) {
                $logger->info(
                    "Page found: controller: {controller}, action: {action}",
                    ["controller" => $route->controller, "action" => $route->action]
                );
                $controller = $diContainer->get($route->controller);
                $controller->{$route->action}();
            }
        }
        $logger->info("Page not found 404");
        error404();
    }
}
