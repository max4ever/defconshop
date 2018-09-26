<?php

namespace Defconshop\Database\Repository;

class ProductRepository extends AbstractRepository
{

    public function getAllproducts(): array
    {
        return $this->pdo->query("SELECT * from product")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProducts(array $ids): array
    {
        $inQuery = implode(",", array_fill(0, count($ids), "?"));
        $statement = $this->pdo->prepare("SELECT * from product WHERE product.id IN ({$inQuery})");
        foreach ($ids as $index => $id) {
            $statement->bindValue($index + 1, $id, \PDO::PARAM_INT);
        }
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}