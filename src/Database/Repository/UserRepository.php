<?php

namespace Defconshop\Database\Repository;

class UserRepository
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function saveNewUser(string $email, string $password, $name): bool
    {
        $user = $this->getUser($email);
        if (!empty($user)) {
            return false;//duplicate email
        }

        $statement = $this->pdo->prepare('INSERT INTO `user` (email, password, name) VALUES (:email, :password, :name)');

        $salt = uniqid(mt_rand(), true);
        return $statement->execute([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'name' => $name
        ]);
    }

    public function checkLogin(string $email, string $password): bool
    {
        $user = $this->getUser($email);
        if (!empty($user['password'])) {
            return password_verify($password, $user['password']);
        }

        return false;
    }

    protected function getUser(string $email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM `user` WHERE email = :email LIMIT 1');
        $statement->bindValue('email', $email);
        $statement->execute();
        $user = $statement->fetch();
        return $user;
    }

}