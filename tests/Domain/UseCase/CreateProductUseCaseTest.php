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
            '89d5a5e0-2d0c-4128-873b-49145e1ad98a',
            1000,
            'Test product'
        ));

        $this->assertEquals('89d5a5e0-2d0c-4128-873b-49145e1ad98a', $product->uuid);
        $this->assertEquals('Test product', $product->name);
        $this->assertEquals(1000, $product->price);
    }

    private function getInputData(string $uuid, int $price, string $name): CreateProductInterface
    {
        $createProduct = $this->createMock(CreateProductInterface::class);
        $createProduct->expects($this->any())->method('getUuid')->willReturn($uuid);
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
