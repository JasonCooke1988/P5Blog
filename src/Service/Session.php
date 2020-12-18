<?php


namespace App\Service;


use App\Model\User;

class Session
{

    public function __construct()
    {
        if(session_id() == '' || !isset($_SESSION)) {
            session_start();
        }
    }

    public function setAttributes(User $user)
    {
        $array = $user->iterate();
        foreach($array as $key => $val) {
            $get = 'get'.$key;
            $_SESSION[$key] = $user->$get();
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

    public function isAuth()
    {
        return isset($_SESSION['auth']);
    }

    public function isAdmin()
    {
        return isset($_SESSION['admin']);
    }

    public function getFullName()
    {
        return $_SESSION['firstName'] . ' ' .  $_SESSION['lastName'];
    }
}