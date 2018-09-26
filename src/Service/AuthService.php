<?php

namespace Defconshop\Service;


class AuthService
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Sign the user as logged in
     */
    public function loginUser($email): void
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
    }

    public function getLoggedinEmail()
    {
        //TODO add check is loggedin
        return $_SESSION['email'];
    }

    /**
     * Kick the user out
     */
    public function logoutUser(): void
    {
        $_SESSION['loggedin'] = false;
        session_destroy();//TODO maybe not, don't loose the cart that way
    }

    /**
     * Returns true if the user is logged in, otherwise false
     * @return bool
     */
    public function checkLoggedin(): bool
    {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }
}