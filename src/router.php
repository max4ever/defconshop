<?php
chdir(Config::$BASE_PATH);//fix for static resoursces

if (preg_match('/\.(?:png|jpg|jpeg|gif|css|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}

$requestUrl = $_SERVER['REQUEST_URI'];

use Defconshop\Controller\Web\CartController;
use Defconshop\Controller\Web\IndexController;
use Defconshop\Controller\Web\RegisterController;
use Defconshop\Database\DatabaseConnection;
use Defconshop\Database\Repository\ProductRepository;
use Defconshop\Form\RegisterForm;
use Defconshop\Form\Validator\EmailFieldValidator;
use Defconshop\Service\CartService;

//match /product/add/123
if (preg_match("^/product/add/(?<product_id>[\d]+)^", $requestUrl, $matches) == 1) {
    $productRepository = new ProductRepository(DatabaseConnection::getInstance());
    $controller = new CartController(new CartService($productRepository));
    $controller->addAction($matches['product_id']);
    return;
} else if ($requestUrl == '/') {
    $controller = new IndexController();
    $productRepository = new ProductRepository(DatabaseConnection::getInstance());
    $cartService = new CartService($productRepository);
    $controller->indexAction($productRepository, $cartService);
    return;
} else if ($requestUrl == '/register') {
    $userRepository = new Defconshop\Database\Repository\UserRepository(DatabaseConnection::getInstance());
    $registerForm = new RegisterForm(new EmailFieldValidator());
    $controller = new RegisterController();
    $controller->registerAction($registerForm, $userRepository);
    return;
}


die('Router: 404 page not found, url not mapped: ' . $requestUrl);