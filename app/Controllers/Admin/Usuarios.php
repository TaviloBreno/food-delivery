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
            $retorno[] = [
                'id' => $usuario->id,
                'value' => $usuario->nome,
            ];
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
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $post['cpf'] = preg_replace('/\D/', '', $post['cpf'] ?? '');
        $post['telefone'] = preg_replace('/\D/', '', $post['telefone'] ?? '');

        // 🔥 VERIFICA DUPLICIDADE COM MENSAGENS ESPECÍFICAS
        $cpfExiste = $this->usuarioModel->where('cpf', $post['cpf'])->first();
        if ($cpfExiste) {
            return redirect()->back()->withInput()->with('erro', '❌ O CPF ' . $post['cpf'] . ' já está cadastrado no sistema. Verifique se você já possui cadastro ou digite um CPF diferente.');
        }

        $emailExiste = $this->usuarioModel->where('email', $post['email'])->first();
        if ($emailExiste) {
            return redirect()->back()->withInput()->with('erro', '❌ O e-mail ' . $post['email'] . ' já está cadastrado. Use outro e-mail ou faça login.');
        }

        $rules = [
            'nome' => 'required|min_length[3]|max_length[120]',
            'email' => 'required|valid_email',
            'cpf' => 'required|exact_length[11]',
            'telefone' => 'required|exact_length[11]',
            'senha' => 'required|min_length[6]',
            'senha_confirmacao' => 'required|matches[senha]',
            'ativo' => 'required|in_list[0,1]',
            'is_admin' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules, $this->usuarioModel->getValidationMessages())) {
            $errors = $this->validator->getErrors();
            $primeiroErro = reset($errors);
            return redirect()->back()->withInput()->with('atencao', '⚠️ ' . $primeiroErro);
        }

        $dados = [
            'nome' => $post['nome'],
            'email' => $post['email'],
            'cpf' => $post['cpf'],
            'telefone' => $post['telefone'],
            'password_hash' => password_hash($post['senha'], PASSWORD_DEFAULT),
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
            'is_admin' => isset($post['is_admin']) ? (int) $post['is_admin'] : 0,
        ];

        $this->usuarioModel->skipValidation(true);

        if ($this->usuarioModel->insert($dados)) {
            return redirect()->to(site_url('admin/usuarios'))->with('sucesso', '✅ Usuário criado com sucesso!');
        }

        return redirect()->back()->with('erro', '❌ Erro ao criar usuário. Tente novamente ou entre em contato com o suporte.');
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

    public function atualizar($id = null)
    {
        $method = strtolower($this->request->getMethod());

        if ($method !== 'post' && $method !== 'put') {
            return redirect()->back();
        }

        $id = (int) ($id ?: $this->request->getPost('id'));

        $usuario = $this->buscaUsuarioOu404($id);

        if ($usuario instanceof RedirectResponse) {
            return $usuario;
        }

        $post = $this->request->getPost();

        $rules = [
            'nome' => 'required|min_length[3]|max_length[120]',
            'email' => 'required|valid_email|is_unique[usuarios.email,id,' . $id . ']',
            'cpf' => 'required|exact_length[11]|is_unique[usuarios.cpf,id,' . $id . ']',
            'telefone' => 'required|exact_length[11]|is_unique[usuarios.telefone,id,' . $id . ']',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'nome' => $post['nome'],
            'email' => $post['email'],
            'cpf' => $post['cpf'],
            'telefone' => $post['telefone'],
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
            'is_admin' => isset($post['is_admin']) ? (int) $post['is_admin'] : 0,
        ];

        if (!empty($post['senha'])) {
            if ($post['senha'] !== $post['senha_confirmacao']) {
                return redirect()->back()->with('atencao', 'As senhas não coincidem')->withInput();
            }

            if (strlen($post['senha']) < 6) {
                return redirect()->back()->with('atencao', 'A senha deve ter pelo menos 6 caracteres')->withInput();
            }

            $dados['password_hash'] = password_hash($post['senha'], PASSWORD_DEFAULT);
        }

        $this->usuarioModel->skipValidation(true);

        if ($this->usuarioModel->update($id, $dados)) {
            return redirect()->to(site_url("admin/usuarios/show/$id"))->with('sucesso', 'Usuário atualizado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao atualizar usuário')->withInput();
    }

    public function excluir($id = null)
    {
        $id = (int) $id;
        $usuario = $this->buscaUsuarioOu404($id);

        if ($usuario instanceof RedirectResponse) {
            return $usuario;
        }

        if ($this->usuarioModel->delete($id)) {
            return redirect()->to(site_url('admin/usuarios'))->with('sucesso', 'Usuário excluído com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao excluir usuário');
    }

    public function restaurar($id = null)
    {
        $id = (int) $id;
        $usuario = $this->buscaUsuarioOu404($id);

        if ($usuario instanceof RedirectResponse) {
            return $usuario;
        }

        if ($this->usuarioModel->delete($id, true)) {
            return redirect()->to(site_url('admin/usuarios'))->with('sucesso', 'Usuário restaurado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao restaurar usuário');
    }

    private function buscaUsuarioOu404(?int $id = null)
    {
        if (!$id || !$usuario = $this->usuarioModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Usuário não encontrado');
        }

        return $usuario;
    }
}
