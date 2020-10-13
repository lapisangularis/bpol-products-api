<?php

declare(strict_types=1);

namespace App\Application\Presenter;

class Presenter
{
    public object $data;

    public function __construct(object $data)
    {
        $this->data = $data;
    }
}
