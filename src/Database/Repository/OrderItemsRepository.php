<?php

namespace Defconshop\Database\Repository;

class OrderItemsRepository extends AbstractRepository
{

    public function addOrderProducts($order_id, $products)
    {
        $statement = $this->pdo->prepare("INSERT INTO `defconshop`.`order_item`(`orderFk`,`productFk`,`quantity`,`price_net`,`order_itemcol`)"
            . "VALUES (:orderFk,:productFk,:quantity,:price_net,:order_itemcol)");

        //TODO maybe use one big insert for all rows
        foreach ($products as $product) {
            $statement->bindParam("orderFk", $order_id);
            $statement->bindParam("productFk", $product['id']);
            $statement->bindParam("quantity", $product['count']);
            $statement->bindParam("price_net", $product['price_net']);
            $statement->bindParam("order_itemcol", $product['price_gross']);
            $statement->execute();
        }

    }

}