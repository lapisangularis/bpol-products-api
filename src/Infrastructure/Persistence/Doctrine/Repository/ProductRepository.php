<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Port\ProductGatewayInterface;
use App\Domain\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;

final class ProductRepository extends BaseRepository implements ProductGatewayInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $product): void
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }
}
