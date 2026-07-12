<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\FormaPagamentoRepositoryInterface;
use App\Models\FormaPagamentoModel;
use App\Traits\RepositoryTrait;
use CodeIgniter\Model;

class FormaPagamentoRepository implements FormaPagamentoRepositoryInterface
{
    use RepositoryTrait;

    protected Model $model;

    public function __construct(FormaPagamentoModel $model)
    {
        $this->model = $model;
    }

    public function countAtivas(): int
    {
        return $this->model->where('ativo', 1)->countAllResults();
    }
}
