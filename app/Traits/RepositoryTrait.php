<?php

declare(strict_types=1);

namespace App\Traits;

use CodeIgniter\Model;

trait RepositoryTrait
{
    public function findAll(int $perPage = 10, ?int $page = null): array
    {
        return $this->model->paginate($perPage, 'default', $page);
    }

    public function findById(int $id): ?object
    {
        return $this->model->withDeleted(true)->find($id);
    }

    public function countAll(): int
    {
        return $this->model->withDeleted(true)->countAllResults();
    }

    public function countWhere(array $conditions): int
    {
        $model = $this->model;

        foreach ($conditions as $key => $value) {
            // 🔥 Verifica se a chave contém operadores especiais
            if (strpos($key, 'IS NOT NULL') !== false || strpos($key, 'IS NULL') !== false) {
                $model = $model->where($key, null, false);
            } else {
                $model = $model->where($key, $value);
            }
        }

        return $model->countAllResults();
    }

    public function getLatest(int $limit = 5): array
    {
        return $this->model->orderBy('id', 'DESC')->findAll($limit);
    }
}
