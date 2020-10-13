<?php

declare(strict_types=1);

namespace App\Application\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseAbstractController extends AbstractFOSRestController
{
    public function createResponse($content = null, $statusCode = Response::HTTP_OK): Response
    {
        return $this->handleView(new View($content, $statusCode));
    }
}
