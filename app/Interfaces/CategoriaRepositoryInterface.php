<?php

declare(strict_types=1);

namespace App\Interfaces;

interface CategoriaRepositoryInterface extends RepositoryInterface
{
    public function countAtivas(): int;
    public function findBySlug(string $slug): ?object;
    public function search(string $term): array;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function softDelete(int $id): bool;
    public function softRestore(int $id): bool;
    public function getPager(): object;
}
