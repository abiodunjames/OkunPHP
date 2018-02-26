# Introduction
A minimal PHP framework for building API built with symfony's components and doctrine ORM inspired by
[ Fabien Potencier's Post](http://symfony.com/doc/current/create_framework/index.html).

## 1. Install Dependencies
Install project dependencies using composer
```
composer install
```
## 2. Configuration database Parameters
Database configuration parameter is located in ```path/to/project/config/config.php```
```php

$dbParams = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'architrave',
    'user' => 'root',
    'password' => '',
];
