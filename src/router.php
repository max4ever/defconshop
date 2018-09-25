<?php

$requestUrl = $_SERVER['REQUEST_URI'];
use Defconshop\Controller\Web\IndexController;

switch ($requestUrl) {
    case '/' :
        $controller = new IndexController();
        $controller->indexAction();
        break;
    default:
        die('404 page not found, url not mapped');
}