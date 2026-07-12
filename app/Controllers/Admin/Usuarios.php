<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\DTOs\UsuarioDTO;
use App\Exceptions\UsuarioException;
use App\Interfaces\UsuarioServiceInterface;
use App\Traits\PaginacaoTrait;
use App\Traits\RespostasTrait;
use App\Helpers\ValidacaoHelper;
use Config\Services;

class Usuarios extends BaseController
{
    use PaginacaoTrait;
    use RespostasTrait;

    private UsuarioServiceInterface $usuarioService;

    public function __construct()
    {
        $this->usuarioService = Services::usuarioService();
    }

    public function index()
    {
        $perPage = $this->getPerPage($this->request);
        $page = $this->getPage($this->request);

        $resultado = $this->usuarioService->listar($perPage, $page);

        $data = [
            'titulo' => 'Listando os usuários',
            'subtitulo' => 'Listagem completa dos usuários cadastrados',
            'usuarios' => $resultado['usuarios'],
            'pager' => $resultado['pager'],
            'perPage' => $resultado['perPage'],
            'total' => $resultado['total'],
        ];

        return view('Admin/Usuarios/index', $data);
    }

    public function procurar()
    {
        if (!$this->request->isAJAX()) {
            return $this->atencao('Requisição inválida.');
        }

        $term = $this->request->getGet('term');
        $usuarios = $this->usuarioService->procurar($term);

        $retorno = array_map(
            fn($usuario) => ['id' => $usuario->id, 'value' => $usuario->nome],
            $usuarios
        );

        return $this->response->setJSON($retorno);
    }

    public function show($id = null)
    {
        try {
            $usuario = $this->usuarioService->buscar((int) $id);

            $data = [
                'titulo' => "Detalhando o usuário {$usuario->nome}",
                'usuario' => $usuario,
            ];

            return view('Admin/Usuarios/show', $data);
        } catch (UsuarioException $e) {
            return $this->atencao($e->getMessage());
        }
    }

    public function criar()
    {
        $data = [
            'titulo' => 'Criar novo usuário',
        ];

        return view('Admin/Usuarios/criar', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return $this->atencao('Método inválido.');
        }

        try {
            $post = $this->request->getPost();

            $post['cpf'] = ValidacaoHelper::limparCpf($post['cpf'] ?? '');
            $post['telefone'] = ValidacaoHelper::limparTelefone($post['telefone'] ?? '');

            $dto = UsuarioDTO::fromArray($post);

            $this->validate($this->getValidationRules());
            $this->usuarioService->criar($dto);

            return $this->sucesso('Usuário criado com sucesso!', site_url('admin/usuarios'));
        } catch (UsuarioException $e) {
            return $this->erro($e->getMessage())->withInput();
        }
    }

    public function editar($id = null)
    {
        try {
            $usuario = $this->usuarioService->buscar((int) $id);

            $data = [
                'titulo' => "Editando o usuário {$usuario->nome}",
                'usuario' => $usuario,
            ];

            return view('Admin/Usuarios/editar', $data);
        } catch (UsuarioException $e) {
            return $this->atencao($e->getMessage());
        }
    }

    public function atualizar($id = null)
    {
        $method = strtolower($this->request->getMethod());

        if (!in_array($method, ['post', 'put'])) {
            return $this->atencao('Método inválido.');
        }

        try {
            $post = $this->request->getPost();

            $post['cpf'] = ValidacaoHelper::limparCpf($post['cpf'] ?? '');
            $post['telefone'] = ValidacaoHelper::limparTelefone($post['telefone'] ?? '');

            $dto = UsuarioDTO::fromArray($post);

            $this->validate($this->getValidationRules((int) $id));
            $this->usuarioService->atualizar((int) $id, $dto);

            return $this->sucesso('Usuário atualizado com sucesso!', site_url("admin/usuarios/show/{$id}"));
        } catch (UsuarioException $e) {
            return $this->erro($e->getMessage())->withInput();
        }
    }

    public function excluir($id = null)
    {
        try {
            $usuarioLogadoId = (int) session()->get('usuario_id');
            $this->usuarioService->excluir((int) $id, $usuarioLogadoId);

            return $this->sucesso('Usuário excluído com sucesso!', site_url('admin/usuarios'));
        } catch (UsuarioException $e) {
            return $this->erro($e->getMessage());
        }
    }

    public function restaurar($id = null)
    {
        try {
            $usuarioLogadoId = (int) session()->get('usuario_id');
            $this->usuarioService->restaurar((int) $id, $usuarioLogadoId);

            return $this->sucesso('Usuário restaurado com sucesso!', site_url('admin/usuarios'));
        } catch (UsuarioException $e) {
            return $this->erro($e->getMessage());
        }
    }

    private function getValidationRules(?int $id = null): array
    {
        $rules = [
            'nome' => 'required|min_length[3]|max_length[120]',
            'email' => 'required|valid_email',
            'cpf' => 'required|exact_length[11]',
            'telefone' => 'required|exact_length[11]',
            'ativo' => 'required|in_list[0,1]',
            'is_admin' => 'required|in_list[0,1]',
        ];

        if (!$id) {
            $rules['senha'] = 'required|min_length[8]';
            $rules['senha_confirmacao'] = 'required|matches[senha]';
        }

        return $rules;
    }
}
