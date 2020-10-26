<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Presenter\ProductPresenter;

interface ProductQuery
{
    public function getByUuid(string $uuid): ProductPresenter;
}
