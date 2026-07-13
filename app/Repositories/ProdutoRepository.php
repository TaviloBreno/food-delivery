<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\ProdutoRepositoryInterface;
use App\Models\ProdutoModel;
use App\Models\CategoriaModel;
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

    public function findBySlug(string $slug): ?object
    {
        return $this->model->where('slug', $slug)->withDeleted(true)->first();
    }

    public function search(string $term): array
    {
        return $this->model->select('produtos.id, produtos.nome, categorias.nome as categoria')
            ->join('categorias', 'categorias.id = produtos.categoria_id')
            ->like('produtos.nome', $term)
            ->withDeleted(true)
            ->get()
            ->getResult();
    }

    public function listarComCategoria(): object
    {
        return $this->model->select('produtos.*, categorias.nome as categoria_nome')
            ->join('categorias', 'categorias.id = produtos.categoria_id')
            ->withDeleted(true);
    }

    public function getUltimosComCategoria(int $limit = 5): array
    {
        return $this->model->select('produtos.*, categorias.nome as categoria_nome')
            ->join('categorias', 'categorias.id = produtos.categoria_id')
            ->orderBy('produtos.id', 'DESC')
            ->findAll($limit);
    }

    public function create(array $data): bool
    {
        $this->model->skipValidation(true);
        return (bool) $this->model->insert($data);
    }

    public function update(int $id, array $data): bool
    {
        $this->model->skipValidation(true);
        return (bool) $this->model->update($id, $data);
    }

    public function softDelete(int $id): bool
    {
        return (bool) $this->model->update($id, ['deletado_em' => date('Y-m-d H:i:s')]);
    }

    public function softRestore(int $id): bool
    {
        return (bool) $this->model->update($id, ['deletado_em' => null]);
    }

    public function getPager(): object
    {
        return $this->model->pager;
    }

    public function getCategoriaNome(int $categoriaId): string
    {
        $categoriaModel = new CategoriaModel();
        $categoria = $categoriaModel->find($categoriaId);
        return $categoria ? $categoria->nome : 'N/A';
    }
}
