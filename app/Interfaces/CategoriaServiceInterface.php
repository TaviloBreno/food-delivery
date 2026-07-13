<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\CategoriaDTO;

interface CategoriaServiceInterface
{
    public function listar(int $perPage, ?int $page): array;
    public function buscar(int $id): object;
    public function procurar(string $term): array;
    public function criar(CategoriaDTO $dto): array;
    public function atualizar(int $id, CategoriaDTO $dto): array;
    public function excluir(int $id): array;
    public function restaurar(int $id): array;
    public function gerarSlug(string $nome): string;
}
