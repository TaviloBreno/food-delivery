<?php

declare(strict_types=1);

namespace App\Interfaces;

interface EntregadorRepositoryInterface extends RepositoryInterface
{
    public function countDisponiveis(): int;
    public function countOcupados(): int;
}
