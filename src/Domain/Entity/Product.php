<?php

namespace App\Domain\Entity;

class Product
{
    public int $id;
    public string $uuid;
    public string $name;
    public int $price;

    public function __construct(string $uuid, string $name, int $price)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->price = $price;
    }
}
