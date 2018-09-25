<?php

require_once __DIR__ . "/src/autoloader.php";

require_once __DIR__ . "/config/dev.php";
Config::init();

if (Config::ENABLE_DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

MyAutoloader::startAutoloader();
require_once __DIR__ . "/src/router.php";
