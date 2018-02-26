<?php

require_once __DIR__.'/../bootstrap.php';

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

$loader = new Loader();

// $loader->addFixture(new \App\DataFixtures\SampleFixture());
// Add other data fixtures

$purger = new ORMPurger();
$executor = new ORMExecutor($entityManager, $purger);

/*
|--------------------------------------------------------------------------
| Execute data fixtures
|--------------------------------------------------------------------------
*/
$executor->execute($loader->getFixtures());

