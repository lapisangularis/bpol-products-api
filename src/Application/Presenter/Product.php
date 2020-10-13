<?php

declare(strict_types=1);

namespace App\Application\Presenter;

use App\Domain\Entity\Product as DomainProduct;

class Product
{
    public int $id;
    public string $name;
    public int $price;

    public function __construct(DomainProduct $product)
    {
        $this->id = $product->getId();
        $this->name = $product->getName();
        $this->price = $product->getPrice();
    }
}
