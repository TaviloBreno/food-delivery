<?php

declare(strict_types=1);

namespace App\Interfaces;

interface CategoriaServiceInterface
{
    public function listar(int $perPage, ?int $page): array;
    public function buscar(int $id): object;
    public function procurar(string $term): array;
    public function criar(array $dados): array;
    public function atualizar(int $id, array $dados): array;
    public function excluir(int $id): array;
    public function restaurar(int $id): array;
    public function gerarSlug(string $nome): string;
}
