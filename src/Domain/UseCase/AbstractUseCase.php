<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Exception\ValidationViolationException;
use App\Domain\Port\ValidatorGatewayInterface;

abstract class AbstractUseCase
{
    private ValidatorGatewayInterface $validator;
    private $exception;

    public function __construct(ValidatorGatewayInterface $validator)
    {
        $this->validator = $validator;
    }

    protected function validate($object): void
    {
        $this->validator->validate($object, $this->getException());
    }

    protected function getException(): ValidationViolationException
    {
        if (!$this->exception) {
            $this->exception = new ValidationViolationException();
        }

        return $this->exception;
    }

    protected function resolveException(): void
    {
        if ($this->exception && $this->exception->hasErrors()) {
            throw $this->exception;
        }
    }
}
