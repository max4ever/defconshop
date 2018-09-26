<?php

require_once __DIR__ . "/../src/autoloader.php";

require_once __DIR__ . "/../config/dev.php";
Config::init();

if (Config::ENABLE_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

MyAutoloader::startAutoloader();


if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}
require_once __DIR__ . "/../src/router.php";
