<?php

require_once __DIR__.'/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Require database configuration file
|--------------------------------------------------------------------------
*/
require_once __DIR__.'/config/config.php';

$entitiesPath = [__DIR__.'/src/Entities']; //Set entity path

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($entitiesPath, $dev, null, null, false);

// Create entity manager
$entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);

// Include routes, endpoints to my application
$routes = include __DIR__.'/src/routes.php';
// Include IoC container file
$container = include __DIR__.'/src/Framework/Container.php';

