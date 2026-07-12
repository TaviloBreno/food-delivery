<?php

declare(strict_types=1);

namespace App\Interfaces;

interface RepositoryInterface
{
    public function findAll(int $perPage = 10, ?int $page = null): array;
    public function findById(int $id): ?object;
    public function countAll(): int;
    public function countWhere(array $conditions): int;  // 🔥 ADICIONADO
    public function getLatest(int $limit = 5): array;
}
