<?php

namespace Defconshop\Controller\Web;

use Defconshop\Controller\AbstractController;
use Defconshop\Database\Repository\ProductRepository;
use Defconshop\Service\CartService;

class IndexController extends AbstractController
{

    public function indexAction(ProductRepository $productRepository, CartService $cartService)
    {
        //TODO add color filter
        $this->render("index.phtml", [
            'products' => $productRepository->getAllproducts(),
            'cart' => $cartService->getCart()
        ]);
    }
}