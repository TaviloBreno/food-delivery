<?php

declare(strict_types=1);

namespace App\Enums;

enum StatusProduto: int
{
    case ATIVO = 1;
    case INATIVO = 0;
    case EXCLUIDO = -1;

    public function label(): string
    {
        return match ($this) {
            self::ATIVO => 'Ativo',
            self::INATIVO => 'Inativo',
            self::EXCLUIDO => 'Excluído',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::ATIVO => 'badge-success',
            self::INATIVO => 'badge-warning',
            self::EXCLUIDO => 'badge-danger',
        };
    }

    public function isAtivo(): bool
    {
        return $this === self::ATIVO;
    }
}
