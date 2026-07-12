<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class CategoriaException extends RuntimeException
{
    public static function naoEncontrada(int $id): self
    {
        return new self("Categoria com ID {$id} não encontrada.", 404);
    }

    public static function nomeJaExiste(string $nome): self
    {
        return new self("A categoria '{$nome}' já existe.", 409);
    }

    public static function slugJaExiste(string $slug): self
    {
        return new self("O slug '{$slug}' já está em uso.", 409);
    }

    public static function jaExcluida(): self
    {
        return new self("Esta categoria já está excluída.", 409);
    }

    public static function naoExcluida(): self
    {
        return new self("Esta categoria não está excluída.", 409);
    }
}
