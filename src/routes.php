<?php
declare(strict_types = 1);
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();


$routes->add('home', new Route('/', [
    '_controller' => 'App\Controllers\HomeController::indexAction',
]));

return $routes;
