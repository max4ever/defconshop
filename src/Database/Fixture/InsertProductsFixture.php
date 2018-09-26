<?php

namespace Defconshop\Database\Fixture;

class InsertProductsFixture
{

    private const NAMES = ["Apple Imac", "Apple Ipad", "Apple Xpad", "ZenPad", "Microsoft Tablet", "Asus something", "Toshiba pad", "Hp touch", "Acer cheap",
        "Honor phone", "Huawei phone", "Xiaomi phone"];
    private const COLORS = ["red", "green", "blue", "yellow"];
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert20Products()
    {
        for ($i = 1; $i <= 20; $i++) {

            $statement = $this->pdo->prepare('INSERT INTO `product` (name, color, price_net, price_gross, image_path) VALUES '
                . '(:name, :color, :price_net, :price_gross, :image_path)');

            $statement->execute([
                'name' => $this::NAMES[array_rand($this::NAMES, 1)],
                'color' => $this::COLORS[array_rand($this::COLORS, 1)],
                'price_net' => mt_rand(100, 1000),
                'price_gross' => mt_rand(100, 1000),
                'image_path' => "product{$i}.png"
            ]);
        }
    }
}