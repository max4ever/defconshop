<?php

namespace Defconshop\Service;

use Defconshop\Database\Repository\ProductRepository;

class CartService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function addProduct(int $product_id)
    {
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
        $result = [];
        if (!empty($_SESSION['cart']['products_id'])) {
            $result = $this->productRepository->getProducts(array_keys($_SESSION['cart']['products_id']));
        }

        foreach ($result as $index => $row) {
            $result[$index]['count'] = $_SESSION['cart']['products_id'][$row['id']];
        }

        return $result;
    }

    public function deleteCart()
    {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
    }
}