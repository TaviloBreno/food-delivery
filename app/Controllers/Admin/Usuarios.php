<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\RedirectResponse;

class Usuarios extends BaseController
{
    private UsuarioModel $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Listando os usuários',
            'subtitulo' => 'Listagem completa dos usuários cadastrados',
            'usuarios' => $this->usuarioModel->findAll(),
        ];

        return view('Admin/Usuarios/index', $data);
    }

    public function procurar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $usuarios = $this->usuarioModel->procurar($this->request->getGet('term'));

        $retorno = [];

        foreach ($usuarios as $usuario) {
            $data['id'] = $usuario->id;
            $data['value'] = $usuario->nome;

            $retorno[] = $data;
        }

        return $this->response->setJSON($retorno);
    }

    public function show($id = null)
    {
        $id = (int) $id;

        $usuario = $this->buscaUsuarioOu404($id);
        
        if ($usuario instanceof RedirectResponse) {
            return $usuario;
        }

        $data = [
            'titulo' => "Detalhando o usuário {$usuario->nome}",
            'usuario' => $usuario,
        ];

        return view("Admin/Usuarios/show", $data);
    }

    public function editar($id = null)
    {
        $id = (int) $id;

        $usuario = $this->buscaUsuarioOu404($id);
        
        if ($usuario instanceof RedirectResponse) {
            return $usuario;
        }

        $data = [
            'titulo' => "Editando o usuário {$usuario->nome}",
            'usuario' => $usuario,
        ];

        return view("Admin/Usuarios/editar", $data);
    }

    /**
     * Busca usuário ou redireciona com erro
     *
     * @param int|null $id
     * @return object|RedirectResponse
     */
    private function buscaUsuarioOu404(?int $id = null)
    {
        if (!$id || !$usuario = $this->usuarioModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Usuário não encontrado');
        }

        return $usuario;
    }
}