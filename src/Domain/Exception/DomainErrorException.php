<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class DomainErrorException extends \Exception
{
    protected $message = 'Domain error';
    protected int $status = 400;

    public function __toString(): string
    {
        return $this->message;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
