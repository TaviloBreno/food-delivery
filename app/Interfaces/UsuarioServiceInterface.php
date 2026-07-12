<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\UsuarioDTO;

interface UsuarioServiceInterface
{
    public function listar(int $perPage, ?int $page): array;
    public function buscar(int $id): ?object;
    public function procurar(string $term): array;
    public function criar(UsuarioDTO $dto): array;
    public function atualizar(int $id, UsuarioDTO $dto): array;
    public function excluir(int $id, int $usuarioLogadoId): array;
    public function restaurar(int $id, int $usuarioLogadoId): array;
    public function validarCpf(string $cpf): bool;
    public function validarEmailUnico(string $email, ?int $id = null): bool;
    public function validarCpfUnico(string $cpf, ?int $id = null): bool;
}
