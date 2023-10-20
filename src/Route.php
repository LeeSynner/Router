<?php

namespace Libs\Router;

//enum HttpMethod
//{
//    case GET;
//    case POST;
//    case PUT;
//    case DELETE;
//}
class Route
{
    public string $controller;
    public string $action;
    public function __construct($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }
}
