<?php

declare(strict_types=1);

namespace App\Application\Presenter;

class ProductPresenter
{
    public string $id;
    public string $name;
    public int $price;

    public function __construct(string $id, string $name, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
}
