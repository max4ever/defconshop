<?php

namespace Defconshop\Controller\Web;

use Defconshop\Controller\AbstractController;
use Defconshop\Database\Repository\ProductRepository;
use Defconshop\Service\CartService;

class IndexController extends AbstractController
{

    public function indexAction(ProductRepository $productRepository, CartService $cartService)
    {
        $color = $_POST['color'] ?? "";
        if (!empty($color)) {
            $products = $productRepository->getAllProductsByColor($color);
        } else {
            $products = $productRepository->getAllproducts();
        }
        $this->render("index.phtml", [
            'products' => $products,
            'cart' => $cartService->getCart()
        ]);
    }
}