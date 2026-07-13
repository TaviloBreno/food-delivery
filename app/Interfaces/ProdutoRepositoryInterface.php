<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ProdutoRepositoryInterface extends RepositoryInterface
{
    public function countAtivos(): int;
    public function countInativos(): int;
    public function countDestaques(): int;
    public function findBySlug(string $slug): ?object;
    public function search(string $term): array;
    public function listarComCategoria(): object;
    public function getUltimosComCategoria(int $limit = 5): array;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function softDelete(int $id): bool;
    public function softRestore(int $id): bool;
    public function getPager(): object;
    public function getCategoriaNome(int $categoriaId): string;
}
