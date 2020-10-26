<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\Adapter\Command\CreateProduct;
use App\Application\Query\ProductQuery;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use League\Tactician\CommandBus;

class ProductController extends BaseAbstractController
{
    /**
     * @FOSRest\Post("/product")
     */
    public function postAction(Request $request, CommandBus $commandBus, ProductQuery $productQuery): Response
    {
        /** @var CreateProduct $createProductCommand */
        $createProductCommand = CreateProduct::createFromRequest($request);
        $commandBus->handle($createProductCommand);

        $productPresenter = $productQuery->getByUuid($createProductCommand->getUuid());

        return $this->createResponse($productPresenter, Response::HTTP_CREATED);
    }
}
