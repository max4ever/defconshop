<?php

namespace Defconshop\Controller\Web;

use \Defconshop\Controller\AbstractController;
use Defconshop\Database\DatabaseConnection;
use Defconshop\Database\Repository\ProductRepository;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $productRepository = new ProductRepository(DatabaseConnection::getInstance());
        $products = $productRepository->getAllproducts();

        $this->render("index.phtml", [
            'products' => $products
        ]);
    }
}