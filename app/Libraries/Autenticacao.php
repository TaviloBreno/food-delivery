<?php

namespace App\Libraries;

use App\Models\UsuarioModel;
use App\Entities\Usuario;

class Autenticacao
{
    private ?Usuario $usuario = null;

    public function login(string $email, string $password): bool
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where('email', $email)->first();

        if ($usuario === null) {
            return false;
        }

        if (!password_verify($password, $usuario->password_hash)) {
            return false;
        }

        if ($usuario->ativo == 0) {
            return false;
        }

        $this->logaUsuario($usuario);
        return true;
    }

    public function logout(): void
    {
        session()->destroy();
    }

    public function pegaUsuarioLogado(): ?Usuario
    {
        if ($this->usuario === null) {
            $this->usuario = $this->pegaUsuarioDaSessao();
        }

        return $this->usuario;
    }

    public function isAdmin(): bool
    {
        $usuario = $this->pegaUsuarioLogado();
        return $usuario && $usuario->is_admin == 1;
    }

    public function isLogged(): bool
    {
        return $this->pegaUsuarioLogado() !== null;
    }

    private function pegaUsuarioDaSessao(): ?Usuario
    {
        if (!session()->has('usuario_id')) {
            return null;
        }

        $usuarioModel = new UsuarioModel();
        return $usuarioModel->find(session()->get('usuario_id'));
    }

    private function logaUsuario(object $usuario): void
    {
        $session = session();
        $session->regenerate();
        $session->set('usuario_id', $usuario->id);
        $session->set('usuario_nome', $usuario->nome);
        $session->set('is_admin', $usuario->is_admin);
    }
}
