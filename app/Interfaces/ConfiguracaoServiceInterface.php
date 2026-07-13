<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\ConfiguracaoDTO;

interface ConfiguracaoServiceInterface
{
    public function getDadosSite(): ConfiguracaoDTO;
    public function getHorariosFuncionamento(): array;
    public function getRedesSociais(): array;
    public function getDadosCompletos(): array;
}
