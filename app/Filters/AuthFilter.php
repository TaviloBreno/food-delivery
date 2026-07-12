<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->has('usuario_id')) {
            return redirect()->to(site_url('login/novo'))->with('atencao', 'Você precisa estar logado para acessar esta página.');
        }

        $usuarioModel = new \App\Models\UsuarioModel();
        $usuario = $usuarioModel->find($session->get('usuario_id'));

        if ($usuario === null) {
            $session->destroy();
            return redirect()->to(site_url('login/novo'))->with('erro', 'Usuário não encontrado.');
        }

        if ($usuario->ativo == 0) {
            $session->destroy();
            return redirect()->to(site_url('login/novo'))->with('erro', 'Usuário inativo. Entre em contato com o administrador.');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não faz nada
    }
}
