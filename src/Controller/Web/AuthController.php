<?php

namespace Defconshop\Controller\Web;

use Defconshop\Controller\AbstractController;
use Defconshop\Database\Repository\UserRepository;
use Defconshop\Form\LoginForm;
use Defconshop\Service\SessionService;

class AuthController extends AbstractController
{
    private $sessionService;

    public function __construct(SessionService $sessionService)
    {
        parent::__construct();
        $this->sessionService = $sessionService;
    }

    public function loginAction(LoginForm $loginForm, UserRepository $userRepository)
    {

        //no point in doing login again, just redirect to home
        if ($this->sessionService->checkLoggedin()) {
            //TODO add a flash message
            header("Location: /");
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($loginForm->validate($_POST)) {

                if ($userRepository->checkLogin($_POST['email'], $_POST['password'])) {
                    $this->sessionService->loginUser();

                    header("Location: /");
                    return;
                } else {
                    $errors = ["User not found or password doesn't match"];
                }
            } else {
                $errors = $loginForm->getErrors();
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