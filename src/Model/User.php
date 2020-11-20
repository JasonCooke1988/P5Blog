<?php


namespace App\Model;


class User extends Entity
{

    protected string $firstName;

    protected string $lastName;

    protected string $email;

    protected string $password;


    public function passwordVerify(string $postPassword)
    {
       return password_verify($this->password, PASSWORD_DEFAULT) != $postPassword;
    }

}