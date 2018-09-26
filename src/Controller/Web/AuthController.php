<?php

namespace Defconshop\Controller\Web;

use Defconshop\Controller\AbstractController;
use Defconshop\Database\Repository\UserRepository;
use Defconshop\Form\LoginForm;
use Defconshop\Service\AuthService;

class AuthController extends AbstractController
{
    /**
     * @var AuthService
     */
    private $sessionService;

    public function __construct(AuthService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function loginAction(LoginForm $loginForm, UserRepository $userRepository)
    {
        if ($this->sessionService->checkLoggedin()) {
            header("Location: /");//TODO add a flash message
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$loginForm->validate($_POST)) {
                $errors = $loginForm->getErrors();
            } else if ($userRepository->checkLogin($_POST['email'], $_POST['password'])) {
                $this->sessionService->loginUser($_POST['email']);
                header("Location: /");
                return;
            } else {
                $errors = ["User not found or password doesn't match"];
            }
        }

        $this->render('login.phtml', [
            'errors' => $errors
        ]);
    }

    public function logoutAction()
    {
        $this->sessionService->logoutUser();
        header("Location: /");
    }
}