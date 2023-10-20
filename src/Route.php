<?php

namespace Synsei\Router;

class Route
{
    public function __construct(
	    public readonly string $controller, 
	    public readonly string $action
    ) { }
}
