<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Adapter\Command\CreateProduct;
use App\Domain\UseCase\CreateProductUseCase;

class CreateProductHandler
{
    private CreateProductUseCase $createProductUseCase;

    public function __construct(CreateProductUseCase $createProductUseCase)
    {
        $this->createProductUseCase = $createProductUseCase;
    }

    public function handle(CreateProduct $command): void
    {
        $this->createProductUseCase->create($command);
    }
}
