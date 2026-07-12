<?php

declare(strict_types=1);

namespace App\Enums;

enum PermissaoUsuario: int
{
    case ADMIN = 1;
    case COMUM = 0;

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::COMUM => 'Usuário comum',
        };
    }
}
