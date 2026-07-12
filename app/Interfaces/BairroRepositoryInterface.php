<?php

declare(strict_types=1);

namespace App\Interfaces;

interface BairroRepositoryInterface extends RepositoryInterface
{
    public function countAtivos(): int;
}
