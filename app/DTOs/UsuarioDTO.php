<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\StatusUsuario;
use App\Enums\PermissaoUsuario;

class UsuarioDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $nome,
        public readonly string $email,
        public readonly ?string $cpf,
        public readonly string $telefone,
        public readonly StatusUsuario $status,
        public readonly PermissaoUsuario $permissao,
        public readonly ?string $senha = null,
        public readonly ?string $senhaConfirmacao = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            nome: $data['nome'],
            email: $data['email'],
            cpf: $data['cpf'] ?? null,
            telefone: $data['telefone'],
            status: StatusUsuario::tryFrom((int) ($data['ativo'] ?? 1)) ?? StatusUsuario::ATIVO,
            permissao: PermissaoUsuario::tryFrom((int) ($data['is_admin'] ?? 0)) ?? PermissaoUsuario::COMUM,
            senha: $data['senha'] ?? null,
            senhaConfirmacao: $data['senha_confirmacao'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'ativo' => $this->status->value,
            'is_admin' => $this->permissao->value,
        ];
    }
}
