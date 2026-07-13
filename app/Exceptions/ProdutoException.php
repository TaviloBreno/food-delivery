<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class ProdutoException extends RuntimeException
{
    public static function naoEncontrado(int $id): self
    {
        return new self("Produto com ID {$id} não encontrado.", 404);
    }

    public static function nomeJaExiste(string $nome): self
    {
        return new self("O produto '{$nome}' já existe.", 409);
    }

    public static function slugJaExiste(string $slug): self
    {
        return new self("O slug '{$slug}' já está em uso.", 409);
    }

    public static function jaExcluido(): self
    {
        return new self("Este produto já está excluído.", 409);
    }

    public static function naoExcluido(): self
    {
        return new self("Este produto não está excluído.", 409);
    }

    public static function imagemInvalida(): self
    {
        return new self("Selecione uma imagem válida.", 422);
    }

    public static function imagemMuitoGrande(): self
    {
        return new self("A imagem deve ter no máximo 2MB.", 422);
    }

    public static function erroUploadImagem(): self
    {
        return new self("Erro ao enviar a imagem. Tente novamente.", 500);
    }
}
