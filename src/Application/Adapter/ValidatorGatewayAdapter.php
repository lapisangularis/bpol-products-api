<?php

declare(strict_types=1);

namespace App\Application\Adapter;

use App\Domain\Exception\ValidationViolationException;
use App\Domain\Port\ValidatorGatewayInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorGatewayAdapter implements ValidatorGatewayInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($value, ValidationViolationException $exception): void
    {
        $violations = $this->validator->validate($value);
        if (!$violations->count()) {
            return;
        }
        foreach ($violations as $violation) {
            $exception->addViolation($violation->getPropertyPath(), $violation->getMessage());
        }
    }
}
