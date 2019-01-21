## Download Required Software

- <https://www.apachefriends.org/download.html>
- <https://getcomposer.org/download/>
- <https://git-scm.com/downloads>

## INSTALLATION

- run `git clone https://github.com/kimtabilon/kiakaha-inventory.git`
- run `composer install`
- create database in **phpmyadmin**
- edit config in **.env **
- run `php artisan migrate`
- change/add roles in **database/seeds/RolesTableSeeder.php**
- run `php artisan db:seed`
- extract jeroennoten.zip and replace vendor/jeroennoten folder 
- run `php artisan serve` and browse <http://127.0.0.1:8000>

## USERS

| ROLE | NAME | EMAIL |
| --- | --- | --- |
| Manager | Christopher	Dickens | christopher.dickens@gmail.com |
| Receiving Coordinator | Ryan	Welch | ryan.welch@gmail.com |
| Cashier | Thomas	North | thomas.north@gmail.com |
