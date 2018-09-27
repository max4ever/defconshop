# Defconshop project

Requirements: **PHP 7.2, MySQL/MariaDB**

### Install
1) Write the correct mysql data in ```config/dev.php```


2) Import demo db from ```defconshop_db.zip```



### Usage
 * Add 20 random products
```bash
defconshop/mysql_scripts$ php add20Products.php
```

 * Start website
```bash
 cd public/
 php -S localhost:8000 index.php 
```


 * For testing
```bash
composer install
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```
