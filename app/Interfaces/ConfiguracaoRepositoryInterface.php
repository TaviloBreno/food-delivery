<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ConfiguracaoRepositoryInterface
{
    public function getDadosSite(): object;
    public function getHorariosFuncionamento(): array;
    public function getRedesSociais(): array;
}
