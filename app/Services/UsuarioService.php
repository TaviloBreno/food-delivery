<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\UsuarioDTO;
use App\Interfaces\UsuarioRepositoryInterface;
use App\Interfaces\UsuarioServiceInterface;
use App\Exceptions\UsuarioException;
use App\Helpers\ValidacaoHelper;

class UsuarioService implements UsuarioServiceInterface
{
    private UsuarioRepositoryInterface $repository;

    public function __construct(UsuarioRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function listar(int $perPage, ?int $page): array
    {
        $usuarios = $this->repository->findAll($perPage, $page);
        $pager = $this->repository->getPager();
        $total = $this->repository->countAll();

        return compact('usuarios', 'pager', 'total', 'perPage');
    }

    public function buscar(int $id): ?object
    {
        $usuario = $this->repository->findById($id);

        if (!$usuario) {
            throw UsuarioException::naoEncontrado($id);
        }

        return $usuario;
    }

    public function procurar(string $term): array
    {
        if (empty($term)) {
            return [];
        }

        return $this->repository->search($term);
    }

    public function criar(UsuarioDTO $dto): array
    {
        $this->validarDadosUnicos($dto);
        $this->validarSenha($dto);

        $this->repository->create($dto);
        return ['success' => true, 'message' => 'Usuário criado com sucesso!'];
    }

    public function atualizar(int $id, UsuarioDTO $dto): array
    {
        $this->validarUsuarioExiste($id);
        $this->validarDadosUnicos($dto, $id);
        $this->validarSenha($dto, true);

        $this->repository->update($id, $dto);
        return ['success' => true, 'message' => 'Usuário atualizado com sucesso!'];
    }

    public function excluir(int $id, int $usuarioLogadoId): array
    {
        $usuario = $this->validarUsuarioExiste($id);
        $this->validarPermissaoExclusao($usuario, $usuarioLogadoId);

        $this->repository->softDelete($id);
        return ['success' => true, 'message' => 'Usuário excluído com sucesso!'];
    }

    public function restaurar(int $id, int $usuarioLogadoId): array
    {
        $usuario = $this->validarUsuarioExiste($id);
        $this->validarPermissaoRestauracao($usuario, $usuarioLogadoId);

        $this->repository->softRestore($id);
        return ['success' => true, 'message' => 'Usuário restaurado com sucesso!'];
    }

    public function validarCpf(string $cpf): bool
    {
        return ValidacaoHelper::validarCpf($cpf);
    }

    public function validarEmailUnico(string $email, ?int $id = null): bool
    {
        $usuario = $this->repository->findByEmail($email);
        return !$usuario || ($id && $usuario->id === $id);
    }

    public function validarCpfUnico(string $cpf, ?int $id = null): bool
    {
        $usuario = $this->repository->findByCpf($cpf);
        return !$usuario || ($id && $usuario->id === $id);
    }

    private function validarUsuarioExiste(int $id): object
    {
        $usuario = $this->repository->findById($id);

        if (!$usuario) {
            throw UsuarioException::naoEncontrado($id);
        }

        return $usuario;
    }

    private function validarDadosUnicos(UsuarioDTO $dto, ?int $id = null): void
    {
        if (!$this->validarEmailUnico($dto->email, $id)) {
            throw UsuarioException::emailJaCadastrado($dto->email);
        }

        if ($dto->cpf && !$this->validarCpfUnico($dto->cpf, $id)) {
            throw UsuarioException::cpfJaCadastrado($dto->cpf);
        }
    }

    private function validarSenha(UsuarioDTO $dto, bool $isUpdate = false): void
    {
        if ($isUpdate && empty($dto->senha)) {
            return;
        }

        if (empty($dto->senha)) {
            throw UsuarioException::senhaObrigatoria();
        }

        if (strlen($dto->senha) < 8) {
            throw UsuarioException::senhaCurta();
        }

        if ($dto->senha !== $dto->senhaConfirmacao) {
            throw UsuarioException::senhasNaoCoincidem();
        }
    }

    private function validarPermissaoExclusao(object $usuario, int $usuarioLogadoId): void
    {
        if ($usuario->deletado_em !== null) {
            throw UsuarioException::usuarioJaExcluido();
        }

        if ($usuario->id === $usuarioLogadoId) {
            throw UsuarioException::naoPodeExcluirProprio();
        }
    }

    private function validarPermissaoRestauracao(object $usuario, int $usuarioLogadoId): void
    {
        if ($usuario->deletado_em === null) {
            throw UsuarioException::usuarioNaoExcluido();
        }
    }
}
