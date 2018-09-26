<?php

namespace Defconshop\Database\Repository;

class ProductRepository
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllproducts(){
        return $this->pdo->query("SELECT * from product")->fetchAll(\PDO::FETCH_ASSOC);
    }
}