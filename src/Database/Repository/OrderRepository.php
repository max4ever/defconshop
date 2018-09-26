<?php

namespace Defconshop\Database\Repository;

class OrderRepository extends AbstractRepository
{

    /**
     * Create a new order and return the row id
     * @param $email
     * @param optional $description
     * @return int
     */
    public function createNewOrder($email, $paymentMethod, $description = null): int
    {
        $statement = $this->pdo->prepare("INSERT INTO `order` (`email`, `pay_method`, `description`) VALUES ( :email, :payMethod, :description )");
        $statement->bindParam("email", $email);
        $statement->bindParam("payMethod", $paymentMethod);
        $statement->bindParam("description", $description);
        $statement->execute();

        return $this->pdo->lastInsertId();
    }

}