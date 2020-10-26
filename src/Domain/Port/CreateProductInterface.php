<?php

declare(strict_types=1);

namespace App\Domain\Port;

interface CreateProductInterface
{
    public function getUuid(): string;
    public function getName(): ?string;
    public function getPrice(): ?int;
}
