<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class ValidationViolationException extends DomainErrorException
{
    protected $violations;
    protected $errors;

    public function __construct($code = 0, \Throwable $previous = null)
    {
        parent::__construct('Validation error', $code, $previous);
    }

    public function getViolations(): ?array
    {
        return $this->violations;
    }

    public function addViolation(string $field, $message): void
    {
        $this->violations[$field][] = (string) $message;
    }

    public function setViolations(array $violations): void
    {
        $this->violations = $violations;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function addError(DomainErrorException $exception): void
    {
        $this->errors[] = $exception;
    }

    public function hasErrors(): bool
    {
        return $this->violations || $this->errors;
    }
}
