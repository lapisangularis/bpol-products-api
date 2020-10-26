<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Entity\Product;
use App\Domain\Port\CreateProductInterface;
use App\Domain\Port\ProductGatewayInterface;
use App\Domain\Port\ValidatorGatewayInterface;

class CreateProductUseCase extends AbstractUseCase
{
    private ProductGatewayInterface $productGateway;

    public function __construct(ProductGatewayInterface $productGateway, ValidatorGatewayInterface $validator)
    {
        parent::__construct($validator);
        $this->productGateway = $productGateway;
    }

    public function create(CreateProductInterface $createProduct): Product
    {
        $this->validate($createProduct);

        $product = new Product($createProduct->getUuid(), $createProduct->getName(), $createProduct->getPrice());

        $this->productGateway->save($product);

        return $product;
    }

    protected function validate($createProduct): void
    {
        parent::validate($createProduct);

        $this->resolveException();
    }
}
