<?php

require_once __DIR__ . "/../src/autoloader.php";
require_once __DIR__ . "/../config/dev.php";
Config::init();
MyAutoloader::startAutoloader();

use Defconshop\Database\Fixture\InsertProductsFixture;
use Defconshop\Database\DatabaseConnection;


$dbFixture = new InsertProductsFixture(DatabaseConnection::getInstance());
$dbFixture->insert20Products();