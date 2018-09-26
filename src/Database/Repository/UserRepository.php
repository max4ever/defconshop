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

    public function saveNewUser(string $email, string $password): bool
    {
        $statement = $this->pdo->prepare('INSERT INTO `user` (email, password) VALUES (:email, :password)');
        echo $statement->debugDumpParams();

        $salt = uniqid(mt_rand(), true);
        return $statement->execute([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

}