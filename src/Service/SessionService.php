<?php

namespace Defconshop\Service;


class SessionService
{

    public function loginUser()
    {
        session_start();
        $_SESSION['loggedin'] = true;
    }

    public function logoutUser()
    {
        session_start();
        $_SESSION['loggedin'] = false;
        session_destroy();//TODO maybe not, don't loose the cart that way
    }

    /**
     * Returns true if the user is logged in, otherwise false
     * @return bool
     */
    public function checkLoggedin(): bool
    {
        session_start();
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }
}