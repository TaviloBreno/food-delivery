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

    public function findBySlug(string $slug): ?object
    {
        return $this->model->where('slug', $slug)->withDeleted(true)->first();
    }

    public function search(string $term): array
    {
        return $this->model->select('id, nome')
            ->like('nome', $term)
            ->withDeleted(true)
            ->get()
            ->getResult();
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
}
