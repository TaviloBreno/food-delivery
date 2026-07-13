<?php

declare(strict_types=1);

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class Checkout extends BaseController
{
    public function index()
    {
        if (!$this->estaLogado()) {
            session()->set('redirect_to', site_url('checkout'));
            return redirect()->to(site_url('login/novo'))->with('atencao', 'Faça login para finalizar seu pedido.');
        }

        $itens = session('carrinho') ?? [];

        if (empty($itens)) {
            return redirect()->to(site_url('carrinho'))->with('erro', 'Seu carrinho está vazio.');
        }

        $data = [
            'titulo' => 'Checkout - Food Delivery',
            'usuario_nome' => session('usuario_nome') ?? 'Visitante',
            'isLoggedIn' => true,
            'itens' => $itens,
            'total' => $this->calcularTotal($itens),
        ];

        return view('Web/checkout/index', $data);
    }

    public function finalizar()
    {
        if (!$this->estaLogado()) {
            return redirect()->to(site_url('login/novo'))->with('atencao', 'Faça login para confirmar o pedido.');
        }

        $itens = session('carrinho') ?? [];

        if (empty($itens)) {
            return redirect()->to(site_url('carrinho'))->with('erro', 'Seu carrinho está vazio.');
        }

        $nome = trim((string) $this->request->getPost('nome'));
        $telefone = trim((string) $this->request->getPost('telefone'));
        $endereco = trim((string) $this->request->getPost('endereco'));
        $observacoes = trim((string) $this->request->getPost('observacoes'));
        $pagamento = trim((string) $this->request->getPost('pagamento'));

        if (empty($nome) || empty($telefone) || empty($endereco) || empty($pagamento)) {
            return redirect()->back()->with('atencao', 'Preencha os campos obrigatórios para finalizar o pedido.');
        }

        session()->remove('carrinho');

        return redirect()->to(site_url('checkout/sucesso'))->with('sucesso', 'Pedido realizado com sucesso!');
    }

    public function sucesso()
    {
        $data = [
            'titulo' => 'Pedido confirmado',
            'usuario_nome' => session('usuario_nome') ?? 'Visitante',
            'isLoggedIn' => true,
        ];

        return view('Web/checkout/sucesso', $data);
    }

    private function estaLogado(): bool
    {
        return session('isLoggedIn') === true || session('usuario_id') !== null;
    }

    private function calcularTotal(array $itens): float
    {
        $total = 0.0;
        foreach ($itens as $item) {
            $total += ($item['preco'] ?? 0) * ($item['quantidade'] ?? 1);
        }

        return $total;
    }
}
