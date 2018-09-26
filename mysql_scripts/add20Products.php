<?php

require_once __DIR__ . "/../src/autoloader.php";
require_once __DIR__ . "/../config/dev.php";
Config::init();
MyAutoloader::startAutoloader();

use Defconshop\Database\DatabaseConnection;
use Defconshop\Database\Fixture\InsertProductsFixture;


$dbFixture = new InsertProductsFixture(DatabaseConnection::getInstance());
$dbFixture->insert20Products();