<?php

namespace App\Libraries;

use App\Models\UsuarioModel;

class Autenticacao
{
    private $usuario;

    public function login(string $email, string $password)
    {
        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel->buscaUsuarioPorEmail($email);

        if ($usuario === null) {
            return false;
        }

        if (!$usuario->verificaPassword($password)) {
            return false;
        }

        $this->logaUsuario($usuario);

        return true;
    }

    private function logaUsuario(object $usuario)
    {
        $session = session();
        $session->regenerate();
        $session->set('usuario_id', $usuario->id);
    }
}
