<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\ProdutoRepositoryInterface;
use App\Models\ProdutoModel;
use App\Traits\RepositoryTrait;
use CodeIgniter\Model;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    use RepositoryTrait;

    protected Model $model;

    public function __construct(ProdutoModel $model)
    {
        $this->model = $model;
    }

    public function countAtivos(): int
    {
        return $this->model->where('ativo', 1)->countAllResults();
    }

    public function countInativos(): int
    {
        return $this->model->where('ativo', 0)->countAllResults();
    }

    public function countDestaques(): int
    {
        return $this->model->where('destaque', 1)->where('ativo', 1)->countAllResults();
    }

    public function getUltimosComCategoria(int $limit = 5): array
    {
        return $this->model
            ->select('produtos.*, categorias.nome as categoria_nome')
            ->join('categorias', 'categorias.id = produtos.categoria_id')
            ->orderBy('produtos.id', 'DESC')
            ->findAll($limit);
    }
}
