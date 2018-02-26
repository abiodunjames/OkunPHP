<?php
declare(strict_types = 1);
use Symfony\Component\HttpFoundation\Request;


$routes = include __DIR__.'/bootstrap.php';
$request = Request::createFromGlobals();

$response = $container->get('app')->handle($request);
$response->send();

