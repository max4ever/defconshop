<?php

namespace Defconshop\Service;

use Defconshop\Database\Repository\ProductRepository;

class CartService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function addProduct(int $product_id)
    {
        session_start();

        //TODO validate product_id really exists in db
        if (empty($_SESSION['cart'])) {
            $_SESSION['cart'] = [
                'products_id' => []
            ];
        }

        if (!isset($_SESSION['cart']['products_id'][$product_id])) {
            $_SESSION['cart']['products_id'][$product_id] = 0;
        }

        $_SESSION['cart']['products_id'][$product_id]++;
    }

    public function getCart()
    {
        session_start();
        $result = [];
        if (!empty($_SESSION['cart']['products_id'])) {
            $result = $this->productRepository->getProducts(array_keys($_SESSION['cart']['products_id']));
        }

        foreach ($result as $index => $row) {
            $result[$index]['count'] = $_SESSION['cart']['products_id'][$row['id']];
        }

        return $result;
    }
}