<?php


namespace App\Model;


class User extends Entity
{
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getRoles(): int
    {
        return $this->roles;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $this->cleanData($email);
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $this->cleanData($password);
    }

    /**
     * @param int $roles
     */
    public function setRoles(int $roles): void
    {
        $this->roles = $this->cleanData($roles);
    }

}