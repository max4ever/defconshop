# defconshop

Requirments: **PHP 7.2**
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
