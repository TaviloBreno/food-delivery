<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\CategoriaRepositoryInterface;
use App\Models\CategoriaModel;
use App\Traits\RepositoryTrait;
use CodeIgniter\Model;

class CategoriaRepository implements CategoriaRepositoryInterface
{
    use RepositoryTrait;

    protected Model $model;

    public function __construct(CategoriaModel $model)
    {
        $this->model = $model;
    }

    public function countAtivas(): int
    {
        return $this->model->where('ativo', 1)->countAllResults();
    }
}
