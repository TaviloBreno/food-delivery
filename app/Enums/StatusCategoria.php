<?php

declare(strict_types=1);

namespace App\Enums;

enum StatusCategoria: int
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

    public function isInativo(): bool
    {
        return $this === self::INATIVO;
    }

    public function isExcluido(): bool
    {
        return $this === self::EXCLUIDO;
    }

    public static function fromString(string $status): self
    {
        return match (strtolower($status)) {
            'ativo' => self::ATIVO,
            'inativo' => self::INATIVO,
            'excluido', 'excluído' => self::EXCLUIDO,
            default => self::ATIVO,
        };
    }
}
