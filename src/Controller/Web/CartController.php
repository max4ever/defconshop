<?php

namespace Defconshop\Controller\Web;

use Defconshop\Controller\AbstractController;
use Defconshop\Database\Repository\OrderItemsRepository;
use Defconshop\Database\Repository\OrderRepository;
use Defconshop\Form\CheckoutForm;
use Defconshop\Service\AuthService;
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

    public function checkoutAction(CheckoutForm $checkoutForm, OrderRepository $orderRepository, OrderItemsRepository $orderItemsRepository, AuthService $authService)
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($checkoutForm->validate($_POST)) {

                try {
                    //TODO move out of the controller
                    $orderRepository->getPdo()->beginTransaction();
                    $order_id = $orderRepository->createNewOrder($authService->getLoggedinEmail(), $_POST["payment_method"]);
                    $products = $this->cartService->getCart();
                    $orderItemsRepository->addOrderProducts($order_id, $products);
                    $this->cartService->deleteCart();
                    $orderRepository->getPdo()->commit();
                } catch (\Exception $e) {
                    $orderRepository->getPdo()->rollBack();
                }

            } else {
                $errors = $checkoutForm->getErrors();
            }
        }

        $this->render('checkout.phtml', [
            'cart' => $this->cartService->getCart(),
            'errors' => $errors
        ]);
    }
}