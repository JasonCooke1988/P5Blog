<?php


namespace App\Manager;


use App\Model\User;

class UserManager extends Manager
{

    public function exists($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':email', $email);

        $query->execute();

        return $query->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO user (email,password,firstName,lastName,active,createdAt) VALUES (:email,:password,:fname,:lname,1,now());";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':email', $data['email']);
        $query->bindValue(':fname', $data['fname']);
        $query->bindValue(':lname', $data['lname']);
        $query->bindValue(':password', password_hash($data['password'], PASSWORD_DEFAULT));

        $query->execute();

        $sql = "SELECT LAST_INSERT_ID();";
        $query = $this->pdo->query($sql);
        return $query->fetchColumn();
    }

    public function login($data)
    {
        $sql = "SELECT user.firstName, user.lastName, user.email, user.password FROM user
                WHERE user.email = :email";

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':email', $data['email']);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class);

        $query->execute();
        $user = $query->fetch();

        if ($user->passwordVerify($data['password']) === false) {
            return false;
        }
        return $user;
    }

    public function isAdmin($email)
    {
        $sql = "SELECT user.roles
                    FROM user
                    WHERE user.email = :email;";

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();

        $roles = $query->fetch();

        if ($roles === null || !in_array('admin',explode(';',$roles['roles']))) {
            return false;
        }

        return true;
    }

}