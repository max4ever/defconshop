<?php

namespace Defconshop\Controller\Web;

use Defconshop\Controller\AbstractController;
use Defconshop\Database\Repository\UserRepository;
use Defconshop\Form\RegisterForm;

class RegisterController extends AbstractController
{
    public function registerAction(RegisterForm $registerForm, UserRepository $userRepository)
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($registerForm->validate($_POST)) {
                //TODO give more detailed errors
                if ($userRepository->saveNewUser($_POST['email'], $_POST['password1'], $_POST['name'])) {
                    header("Location: /login");
                    return;
                } else {
                    $errors = ['Error saving the username'];
                }
            } else {
                $errors = $registerForm->getErrors();
            }
        }

        $this->render('register.phtml', [
            'errors' => $errors
        ]);
    }
}