<?php
chdir(Config::$BASE_PATH);//fix for static resoursces

if (preg_match('/\.(?:png|jpg|jpeg|gif|css|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}

$requestUrl = $_SERVER['REQUEST_URI'];

use Defconshop\Controller\Web\AuthController;
use Defconshop\Controller\Web\CartController;
use Defconshop\Controller\Web\IndexController;
use Defconshop\Controller\Web\RegisterController;
use Defconshop\Database\DatabaseConnection;
use Defconshop\Database\Repository\OrderItemsRepository;
use Defconshop\Database\Repository\OrderRepository;
use Defconshop\Database\Repository\ProductRepository;
use Defconshop\Database\Repository\UserRepository;
use Defconshop\Form\CheckoutForm;
use Defconshop\Form\LoginForm;
use Defconshop\Form\RegisterForm;
use Defconshop\Form\Validator\EmailFieldValidator;
use Defconshop\Service\AuthService;
use Defconshop\Service\CartService;

//match /product/add/123
if (preg_match("^/product/add/(?<product_id>[\d]+)^", $requestUrl, $matches) == 1) {
    $productRepository = new ProductRepository(DatabaseConnection::getInstance());
    $controller = new CartController(new CartService($productRepository));
    $controller->addAction($matches['product_id']);
} else if ($requestUrl == '/') {
    $controller = new IndexController();
    $productRepository = new ProductRepository(DatabaseConnection::getInstance());
    $cartService = new CartService($productRepository);
    $controller->indexAction($productRepository, $cartService);
} else if ($requestUrl == '/register') {
    $userRepository = new UserRepository(DatabaseConnection::getInstance());
    $registerForm = new RegisterForm(new EmailFieldValidator());
    $controller = new RegisterController();
    $controller->registerAction($registerForm, $userRepository);
} else if ($requestUrl == '/login') {
    $authService = new AuthService();
    $controller = new AuthController($authService);
    $loginForm = new LoginForm(new EmailFieldValidator());
    $userRepository = new UserRepository(DatabaseConnection::getInstance());
    $controller->loginAction($loginForm, $userRepository);
} else if ($requestUrl == '/logout') {
    $authService = new AuthService();
    $controller = new AuthController($authService);
    $controller->logoutAction();
} else if ($requestUrl == '/checkout') {
    $authService = new AuthService();
    if (!$authService->checkLoggedin()) {
        die('You must be loggedin');
    }
    $productRepository = new ProductRepository(DatabaseConnection::getInstance());
    $controller = new CartController(new CartService($productRepository));
    $checkoutForm = new CheckoutForm();
    $orderRepository = new OrderRepository(DatabaseConnection::getInstance());
    $orderItemsRepository = new OrderItemsRepository(DatabaseConnection::getInstance());
    $authService = new AuthService();
    $controller->checkoutAction($checkoutForm, $orderRepository, $orderItemsRepository, $authService);
} else {
    die('Router: 404 page not found, url not mapped: ' . $requestUrl);
}

