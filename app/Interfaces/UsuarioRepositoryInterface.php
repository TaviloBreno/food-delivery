<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\UsuarioDTO;

interface UsuarioRepositoryInterface
{
    public function findAll(int $perPage, ?int $page): array;
    public function findById(int $id): ?object;
    public function findByEmail(string $email): ?object;
    public function findByCpf(string $cpf): ?object;
    public function search(string $term): array;
    public function create(UsuarioDTO $dto): bool;
    public function update(int $id, UsuarioDTO $dto): bool;
    public function softDelete(int $id): bool;
    public function softRestore(int $id): bool;
    public function countAll(): int;
    public function getPager(): object;
}
