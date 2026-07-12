<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Autenticacao;

class Login extends BaseController
{
    private Autenticacao $auth;

    public function __construct()
    {
        $this->auth = new Autenticacao();
    }

    public function novo()
    {
        if ($this->auth->isLogged()) {
            return redirect()->to(site_url('admin/usuarios'));
        }

        $data = [
            'titulo' => 'Realize o login',
        ];

        return view('Login/novo', $data);
    }

    public function autenticar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            return redirect()->back()->with('atencao', 'Preencha todos os campos.')->withInput();
        }

        if ($this->auth->login($email, $password)) {
            $usuario = $this->auth->pegaUsuarioLogado();
            return redirect()->to(site_url('admin/usuarios'))->with('sucesso', 'Bem-vindo, ' . $usuario->nome . '!');
        }

        return redirect()->back()->with('erro', 'E-mail ou senha inválidos.')->withInput();
    }

    public function logout()
    {
        $this->auth->logout();
        return redirect()->to(site_url('login/novo'))->with('info', 'Você saiu do sistema.');
    }
}
