<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Autenticacao;
use App\Models\UsuarioModel;

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

    public function esqueci()
    {
        if ($this->auth->isLogged()) {
            return redirect()->to(site_url('admin/usuarios'));
        }

        $data = [
            'titulo' => 'Recuperar senha',
        ];

        return view('Login/esqueci', $data);
    }

    public function solicitarReset()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $email = $this->request->getPost('email');

        if (empty($email)) {
            return redirect()->back()->with('atencao', 'Digite seu e-mail para recuperar a senha.')->withInput();
        }

        $usuarioModel = new UsuarioModel();
        $token = $usuarioModel->gerarTokenReset($email);

        if (!$token) {
            return redirect()->back()->with('erro', 'E-mail não encontrado.')->withInput();
        }

        $link = site_url("login/redefinir/{$token}");

        $this->enviarEmailReset($email, $link);

        return redirect()->to(site_url('login/novo'))->with('sucesso', 'Enviamos um link de recuperação para seu e-mail.');
    }

    public function redefinir($token = null)
    {
        if ($this->auth->isLogged()) {
            return redirect()->to(site_url('admin/usuarios'));
        }

        if (empty($token)) {
            return redirect()->to(site_url('login/novo'))->with('erro', 'Token inválido.');
        }

        $usuarioModel = new UsuarioModel();

        if (!$usuarioModel->tokenValido($token)) {
            return redirect()->to(site_url('login/novo'))->with('erro', 'Token inválido ou expirado.');
        }

        $data = [
            'titulo' => 'Redefinir senha',
            'token' => $token,
        ];

        return view('Login/redefinir', $data);
    }

    public function salvarNovaSenha()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $token = $this->request->getPost('token');
        $senha = $this->request->getPost('senha');
        $senhaConfirmacao = $this->request->getPost('senha_confirmacao');

        if (empty($token)) {
            return redirect()->to(site_url('login/novo'))->with('erro', 'Token inválido.');
        }

        if (empty($senha) || empty($senhaConfirmacao)) {
            return redirect()->back()->with('atencao', 'Preencha todos os campos.')->withInput();
        }

        if (strlen($senha) < 8) {
            return redirect()->back()->with('atencao', 'A senha deve ter no mínimo 8 caracteres.')->withInput();
        }

        if ($senha !== $senhaConfirmacao) {
            return redirect()->back()->with('atencao', 'As senhas não coincidem.')->withInput();
        }

        $usuarioModel = new UsuarioModel();

        if (!$usuarioModel->tokenValido($token)) {
            return redirect()->to(site_url('login/novo'))->with('erro', 'Token inválido ou expirado.');
        }

        if ($usuarioModel->redefinirSenha($token, $senha)) {
            return redirect()->to(site_url('login/novo'))->with('sucesso', 'Senha redefinida com sucesso! Faça login com sua nova senha.');
        }

        return redirect()->back()->with('erro', 'Erro ao redefinir senha. Tente novamente.')->withInput();
    }

    /**
     * 🔥 ENVIO DE E-MAIL (SIMULAÇÃO)
     * Em produção, use: CodeIgniter\Email\Email ou PHPMailer
     */
    private function enviarEmailReset(string $email, string $link)
    {
        $assunto = 'Recuperação de senha - Food Delivery';
        $mensagem = "
            <h2>Recuperação de senha</h2>
            <p>Você solicitou a recuperação de senha do sistema Food Delivery.</p>
            <p>Clique no link abaixo para redefinir sua senha:</p>
            <p><a href='{$link}' style='background: #ff6b35; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Redefinir minha senha</a></p>
            <p>Este link é válido por <strong>1 hora</strong>.</p>
            <p>Se você não solicitou esta recuperação, ignore este e-mail.</p>
            <hr>
            <p style='color: #6c757d; font-size: 12px;'>Food Delivery - Sistema de pedidos online</p>
        ";

        // 🔥 SIMULAÇÃO: Exibe o link na tela
        // Em produção, remova este echo e use uma biblioteca de e-mail
        echo "<html><body style='font-family: Arial, sans-serif; padding: 40px;'>";
        echo "<div style='max-width: 600px; margin: 0 auto; background: #f8f9fa; padding: 30px; border-radius: 10px;'>";
        echo "<h2 style='color: #ff6b35;'>📧 E-mail enviado com sucesso!</h2>";
        echo "<p><strong>Para:</strong> {$email}</p>";
        echo "<p><strong>Assunto:</strong> {$assunto}</p>";
        echo "<div style='background: #fff; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #dee2e6;'>";
        echo "<p><strong>🔗 Link de recuperação:</strong></p>";
        echo "<p><a href='{$link}' style='word-break: break-all;'>{$link}</a></p>";
        echo "</div>";
        echo "<p style='color: #6c757d; font-size: 14px;'>⏰ Válido por 1 hora</p>";
        echo "<p style='color: #6c757d; font-size: 14px;'>⚠️ Em produção, este e-mail seria enviado para o usuário.</p>";
        echo "</div>";
        echo "</body></html>";
        exit();
    }
}
