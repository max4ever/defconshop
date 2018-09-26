<?php
chdir(Config::$BASE_PATH);//fix for static resoursces

if (preg_match('/\.(?:png|jpg|jpeg|gif|css|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}

$requestUrl = $_SERVER['REQUEST_URI'];
use Defconshop\Controller\Web\IndexController;

switch ($requestUrl) {
    case '/' :
        $controller = new IndexController();
        $controller->indexAction();
        break;
    default:
        //maybe it's static content
        $staticFile = realpath(Config::$BASE_PATH . "public" . DIRECTORY_SEPARATOR . $requestUrl);
        var_dump($staticFile);
        if (file_exists($staticFile)){
            if ("png" == pathinfo($staticFile, PATHINFO_EXTENSION)){

                die('yahoo');
            }
            else{
                die('boo');
            }
        }
        die('Router: 404 page not found, url not mapped: ' . $requestUrl);
}