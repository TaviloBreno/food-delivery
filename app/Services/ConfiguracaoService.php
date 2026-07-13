<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\ConfiguracaoDTO;
use App\Interfaces\ConfiguracaoRepositoryInterface;
use App\Interfaces\ConfiguracaoServiceInterface;

class ConfiguracaoService implements ConfiguracaoServiceInterface
{
    private ConfiguracaoRepositoryInterface $repository;

    public function __construct(ConfiguracaoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getDadosSite(): ConfiguracaoDTO
    {
        $dados = $this->repository->getDadosSite();
        return ConfiguracaoDTO::fromArray((array) $dados);
    }

    public function getHorariosFuncionamento(): array
    {
        return $this->repository->getHorariosFuncionamento();
    }

    public function getRedesSociais(): array
    {
        return $this->repository->getRedesSociais();
    }

    public function getDadosCompletos(): array
    {
        $dados = $this->getDadosSite();

        return [
            'configuracao' => $dados,
            'horariosFuncionamento' => $this->getHorariosFuncionamento(),
            'redesSociais' => $this->getRedesSociais()
        ];
    }
}
