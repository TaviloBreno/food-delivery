<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\UsuarioDTO;
use App\Interfaces\UsuarioRepositoryInterface;
use App\Models\UsuarioModel;
use App\Traits\RepositoryTrait;
use CodeIgniter\Model;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    use RepositoryTrait;

    protected Model $model;

    public function __construct(UsuarioModel $model)
    {
        $this->model = $model;
    }

    public function countDeletados(): int
    {
        return $this->model->withDeleted()
            ->where('deletado_em IS NOT NULL')
            ->countAllResults();
    }

    public function findByEmail(string $email): ?object
    {
        return $this->model->where('email', $email)->withDeleted(true)->first();
    }

    public function findByCpf(string $cpf): ?object
    {
        return $this->model->where('cpf', $cpf)->withDeleted(true)->first();
    }

    public function search(string $term): array
    {
        return $this->model->select('id, nome')
            ->like('nome', $term)
            ->withDeleted(true)
            ->get()
            ->getResult();
    }

    public function create(UsuarioDTO $dto): bool
    {
        $dados = $dto->toArray();
        $dados['password_hash'] = password_hash($dto->senha, PASSWORD_DEFAULT);

        $this->model->skipValidation(true);
        return (bool) $this->model->insert($dados);
    }

    public function update(int $id, UsuarioDTO $dto): bool
    {
        $dados = $dto->toArray();

        if (!empty($dto->senha)) {
            $dados['password_hash'] = password_hash($dto->senha, PASSWORD_DEFAULT);
        }

        $this->model->skipValidation(true);
        return (bool) $this->model->update($id, $dados);
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
