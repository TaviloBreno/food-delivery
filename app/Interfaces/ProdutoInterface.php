<?php

namespace App\Interfaces;

interface ProdutoInterface
{
    public function getDestaques(): array;
    public function getProdutosPorCategoria(int $categoriaId): array;
    public function getCategoriasMenu(): array;
}
