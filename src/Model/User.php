<?php


namespace App\Model;


class User extends Entity
{

    protected string $firstName;

    protected string $lastName;

    protected string $email;

    protected string $password;

    protected int $roles;


    /**
     * @param string $postPassword
     * @return bool
     */
    public function passwordVerify(string $postPassword): bool
    {
       return password_verify($postPassword, $this->password);
    }

    /**
     * @return bool
     */
    public function isRoleAdmin(): bool
    {
        return $this->roles === 1;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

}