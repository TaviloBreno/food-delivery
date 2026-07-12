<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ProdutoRepositoryInterface extends RepositoryInterface
{
    public function countAtivos(): int;
    public function countInativos(): int;
    public function countDestaques(): int;
    public function getUltimosComCategoria(int $limit = 5): array;
}
