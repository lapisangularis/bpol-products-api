<?php

namespace App\Infrastructure\Persistence\Doctrine\Dbal;

use App\Application\Presenter\ProductPresenter;
use Doctrine\DBAL\Connection;
use App\Application\Query\ProductQuery;

class DbalProductQuery implements ProductQuery
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getByUuid(string $uuid): ProductPresenter
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('p.uuid', 'p.name', 'p.price')
            ->from('product', 'p')
            ->where('p.uuid = :uuid')
            ->setParameter('uuid', $uuid);

        $productData = $this->connection->fetchAssociative($queryBuilder->getSQL(), $queryBuilder->getParameters());

        return new ProductPresenter($productData['uuid'], $productData['name'], $productData['price']);
    }
}
