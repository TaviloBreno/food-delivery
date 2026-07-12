<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class UsuarioException extends RuntimeException
{
    public static function naoEncontrado(int $id): self
    {
        return new self("Usuário com ID {$id} não encontrado.", 404);
    }

    public static function emailJaCadastrado(string $email): self
    {
        return new self("O e-mail '{$email}' já está cadastrado.", 409);
    }

    public static function cpfJaCadastrado(string $cpf): self
    {
        return new self("O CPF '{$cpf}' já está cadastrado.", 409);
    }

    public static function senhaObrigatoria(): self
    {
        return new self("A senha é obrigatória.", 422);
    }

    public static function senhaCurta(): self
    {
        return new self("A senha deve ter no mínimo 8 caracteres.", 422);
    }

    public static function senhasNaoCoincidem(): self
    {
        return new self("As senhas não coincidem.", 422);
    }

    public static function usuarioJaExcluido(): self
    {
        return new self("Este usuário já está excluído.", 409);
    }

    public static function usuarioNaoExcluido(): self
    {
        return new self("Este usuário não está excluído.", 409);
    }

    public static function naoPodeExcluirProprio(): self
    {
        return new self("Você não pode excluir a si mesmo.", 403);
    }

    public static function semPermissao(): self
    {
        return new self("Você não tem permissão para esta ação.", 403);
    }
}
