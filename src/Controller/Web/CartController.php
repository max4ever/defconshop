<?php

namespace Defconshop\Controller\Web;

use Defconshop\Controller\AbstractController;
use Defconshop\Service\CartService;

class CartController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Add a product to the cart
     * @param int $product_id
     */
    public function addAction(int $product_id)
    {
        $this->cartService->addProduct($product_id);

        header("Location: /");
    }
}