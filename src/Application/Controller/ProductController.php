<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\Adapter\CreateProduct;
use App\Application\Presenter\ProductPresenter;
use App\Domain\UseCase\CreateProductUseCase;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends BaseAbstractController
{
    /**
     * @FOSRest\Post("/product")
     */
    public function postAction(
        Request $request,
        CreateProductUseCase $createProductUseCase
    ): Response {
        $createRequestData = CreateProduct::createFromRequest($request);
        $product = $createProductUseCase->create($createRequestData);

        return $this->createResponse(new ProductPresenter($product), Response::HTTP_CREATED);
    }
}
