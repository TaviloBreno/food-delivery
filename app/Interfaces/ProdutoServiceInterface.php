<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\ProdutoDTO;

interface ProdutoServiceInterface
{
    public function listar(int $perPage, ?int $page): array;
    public function buscar(int $id): object;
    public function procurar(string $term): array;
    public function criar(ProdutoDTO $dto): array;
    public function atualizar(int $id, ProdutoDTO $dto): array;
    public function excluir(int $id): array;
    public function restaurar(int $id): array;
    public function salvarImagem(int $id, object $imagem): array;
    public function gerarSlug(string $nome): string;
    public function getCategoriasAtivas(): array;
}
