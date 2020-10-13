<?php

declare(strict_types=1);

namespace App\Tests\Domain\UseCase;

use App\Domain\Port\CreateProductInterface;
use App\Domain\Port\ProductGatewayInterface;
use App\Domain\Port\ValidatorGatewayInterface;
use App\Domain\UseCase\CreateProductUseCase;
use PHPUnit\Framework\TestCase;

class CreateProductUseCaseTest extends TestCase
{
    public function testCreate_NewProduct_ProductCreated(): void
    {
        $createProductUseCase = $this->getCreateProductUseCase();
        $product = $createProductUseCase->create($this->getInputData(
            1000,
            'Test product'
        ));

        $this->assertEquals('Test product', $product->name);
        $this->assertEquals(1000, $product->price);
    }

    private function getInputData(int $price, string $name): CreateProductInterface
    {
        $createProduct = $this->createMock(CreateProductInterface::class);
        $createProduct->expects($this->any())->method('getName')->willReturn($name);
        $createProduct->expects($this->any())->method('getPrice')->willReturn($price);

        return $createProduct;
    }

    private function getCreateProductUseCase(): CreateProductUseCase
    {
        return new CreateProductUseCase(
            $this->createMock(ProductGatewayInterface::class),
            $this->createMock(ValidatorGatewayInterface::class)
        );
    }
}
