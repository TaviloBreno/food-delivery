<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->has('usuario_id')) {
            return redirect()->to(site_url('login/novo'))->with('atencao', 'Você precisa estar logado para acessar esta página.');
        }

        if ($session->get('is_admin') != 1) {
            return redirect()->to(site_url('/'))->with('erro', 'Você não tem permissão para acessar esta área.');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não faz nada
    }
}
