# Install Instructions
Thank you for taking your time to review my code. I sincerely look forward to your comments after reviewing and ultimately learn more.

 I thought of using PHP Frameworks like Laravel, Lumen, Symfony, Zend to build this challenge but I felt that these  frameworks are highly suitable for big project and would obviously would pull too many dependencies that I will never get to use for this challenge.

So I decided to create a simple framework by pulling only components I need for this challenge in line with this [ Fabien Potencier's Post](http://symfony.com/doc/current/create_framework/index.html).

I used MVC in my approach and also employed Event Driven Architecture for modifying controllers' responses.

I look forward to your comments.



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
```
## 3. Generate database schema
```
vendor/bin/doctrine orm:schema-tool:create
```
On windows, you can run this, if the snippet above does not work
```
"vendor/bin/doctrine.bat" orm:schema-tool:create
```
## 4. Populate database with test data
There are data fixtures for all entities. Tables can be populated for testing purposes by running ```php /bin/load-fixture.php``` from console.

## 5. Authentication
Of course we need an authentication token to determine if a user is an admin or a normal user. I have created a page one can use to obtain  tokens for users in the database

Make a curl request to  project home page e.g ```http://localhost:8000``` to get a list of  users,roles and  fresh authentication token.
```json
[
    {
        "name": "Allan",
        "role": [
            "normal"
        ],
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIiwianRpIjoiNTY4NTdjZmM3MDlkMzk5NmYwNTcyNTJjMTZlYzQ2NTZmNTI5MjgwMiJ9.eyJpc3MiOiJhcmNoaXRyYXZlLmRldiIsImF1ZCI6ImFyY2hpdHJhdmUuZGV2IiwianRpIjoiNTY4NTdjZmM3MDlkMzk5NmYwNTcyNTJjMTZlYzQ2NTZmNTI5MjgwMiIsImlhdCI6MTUxNzY3Mzk0NSwibmJmIjoxNTE3NjczOTQ1LCJleHAiOjE1MTc3MDk5NDUsInV1aWQiOjF9."
    },
    {
        "name": "Prince",
        "role": [
            "admin"
        ],
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIiwianRpIjoiNTY4NTdjZmM3MDlkMzk5NmYwNTcyNTJjMTZlYzQ2NTZmNTI5MjgwMiJ9.eyJpc3MiOiJhcmNoaXRyYXZlLmRldiIsImF1ZCI6ImFyY2hpdHJhdmUuZGV2IiwianRpIjoiNTY4NTdjZmM3MDlkMzk5NmYwNTcyNTJjMTZlYzQ2NTZmNTI5MjgwMiIsImlhdCI6MTUxNzY3Mzk0NSwibmJmIjoxNTE3NjczOTQ1LCJleHAiOjE1MTc3MDk5NDUsInV1aWQiOjJ9."
    }
    ]
```
Now, we can use this token to make curl request to ```http://localhost:8000/assets```

```
 curl -H "Authorization: Bearer xxxxxxxxxxxxxx" http://localhost:8000/assets
```
