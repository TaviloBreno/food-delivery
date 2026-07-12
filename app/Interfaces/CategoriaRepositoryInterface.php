<?php

declare(strict_types=1);

namespace App\Interfaces;

interface CategoriaRepositoryInterface extends RepositoryInterface
{
    public function countAtivas(): int;
}
