<?php


namespace App\Service;


use App\Model\User;

class Session extends User
{

    private User $user;

    public function __construct()
    {
        if(session_id() == '' || !isset($_SESSION)) {
            session_start();
        }
    }

    public function setAttributes(User $user)
    {
        foreach($user as $key => $val) {
            $_SESSION[$key] = $val;
        }
        $this->setAuthenticated();
    }

    public function getAttribute($attr)
    {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }

    public function setAuthenticated($auth = true)
    {
        $_SESSION['auth'] = $auth;
    }

    public function setAdmin($auth = true)
    {
        $_SESSION['admin'] = $auth;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
    
}