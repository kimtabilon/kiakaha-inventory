## STEPS

- run `git clone https://github.com/kimtabilon/kiakaha-inventory.git`
- create database in **phpmyadmin**
- edit config in **.env **
- run `php artisan migrate`
- change/add roles in **database/seeds/RolesTableSeeder.php**
- run `php artisan db:seed`

## USERS

| ROLE | NAME | EMAIL |
| --- | --- | --- |
| Manager | Christopher	Dickens | christopher.dickens@gmail.com |
| Receiving Coordinator | Ryan	Welch | ryan.welch@gmail.com |
| Cashier | Thomas	North | thomas.north@gmail.com |
