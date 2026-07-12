<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\EntregadorRepositoryInterface;
use App\Models\EntregadorModel;
use App\Traits\RepositoryTrait;
use CodeIgniter\Model;

class EntregadorRepository implements EntregadorRepositoryInterface
{
    use RepositoryTrait;

    protected Model $model;

    public function __construct(EntregadorModel $model)
    {
        $this->model = $model;
    }

    public function countDisponiveis(): int
    {
        return $this->model->where('disponivel', 1)->where('ativo', 1)->countAllResults();
    }

    public function countOcupados(): int
    {
        return $this->model->where('disponivel', 0)->where('ativo', 1)->countAllResults();
    }
}
