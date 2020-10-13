<?php

declare(strict_types=1);

namespace App\Application\Adapter;

use App\Application\Adapter\AdapterFromRequestTrait;
use App\Domain\Port\CreateProductInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateProduct implements CreateProductInterface
{
    use AdapterFromRequestTrait;

    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @Assert\Type("int")
     * @Assert\NotBlank()
     */
    protected $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
