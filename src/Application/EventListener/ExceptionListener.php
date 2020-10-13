<?php

declare(strict_types=1);

namespace App\Application\EventListener;

use App\Domain\Exception\DomainErrorException;
use App\Domain\Exception\ValidationViolationException;
use FOS\RestBundle\Exception\InvalidParameterException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        if ($event->getException() instanceof ValidationViolationException) {
            $resp = $this->handleDomainErrorException($event->getException());
        } else {
            $resp = $this->handleOtherErrorException($event->getException());
        }
        $event->setResponse($resp);
    }

    protected function handleOtherErrorException(\Exception $exception): JsonResponse
    {
        $responseData = $responseData = [
            'data' => [
                'message' => $exception->getMessage(),
            ],
        ];

        return new JsonResponse($responseData, $this->getStatus($exception));
    }

    protected function handleDomainErrorException(ValidationViolationException $exception): JsonResponse
    {
        $responseData['data']['violations'] = $exception->getViolations();

        return new JsonResponse($responseData, $exception->getStatus());
    }

    private function getStatus(\Exception $exception)
    {
        if ($exception instanceof DomainErrorException) {
            return $exception->getStatus();
        }
        if ($exception instanceof InvalidParameterException) {
            return 400;
        }
        if ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        }

        return 500;
    }
}
