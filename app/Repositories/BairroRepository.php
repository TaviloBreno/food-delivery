<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\BairroRepositoryInterface;
use App\Models\BairroAtendidoModel;
use App\Traits\RepositoryTrait;
use CodeIgniter\Model;

class BairroRepository implements BairroRepositoryInterface
{
    use RepositoryTrait;

    protected Model $model;

    public function __construct(BairroAtendidoModel $model)
    {
        $this->model = $model;
    }

    public function countAtivos(): int
    {
        return $this->model->where('ativo', 1)->countAllResults();
    }
}
