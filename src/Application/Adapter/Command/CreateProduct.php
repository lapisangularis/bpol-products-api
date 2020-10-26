<?php

declare(strict_types=1);

namespace App\Application\Adapter\Command;

use App\Domain\Port\CreateProductInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use App\Application\Adapter\AdapterFromRequestTrait;

class CreateProduct implements CreateProductInterface
{
    use AdapterFromRequestTrait;

    private $uuid;

    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @Assert\Type("int")
     * @Assert\NotBlank()
     */
    private $price;

    public function __construct($name, $price)
    {
        $this->uuid = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->price = $price;
    }

    public function getUuid(): string
    {
        return $this->uuid;
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
