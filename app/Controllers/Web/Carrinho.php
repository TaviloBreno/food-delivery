<?php

declare(strict_types=1);

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class Carrinho extends BaseController
{
    public function index()
    {
        if (!$this->estaLogado()) {
            session()->set('redirect_to', site_url('carrinho'));
            return redirect()->to(site_url('login/novo'))->with('atencao', 'Faça login para continuar o pedido.');
        }

        $itens = session('carrinho') ?? [];

        $data = [
            'titulo' => 'Seu carrinho',
            'usuario_nome' => session('usuario_nome') ?? 'Visitante',
            'isLoggedIn' => true,
            'itens' => $itens,
            'total' => $this->calcularTotal($itens),
        ];

        return view('Web/carrinho/index', $data);
    }

    public function adicionar()
    {
        $produtoId = (int) ($this->request->getGet('produto_id') ?? 0);
        $nome = (string) ($this->request->getGet('nome') ?? 'Produto');
        $preco = (float) ($this->request->getGet('preco') ?? 0);
        $quantidade = max(1, (int) ($this->request->getGet('quantidade') ?? 1));

        if ($produtoId <= 0) {
            return redirect()->back()->with('erro', 'Produto inválido.');
        }

        $carrinho = session('carrinho') ?? [];
        $carrinho[$produtoId] = [
            'id' => $produtoId,
            'nome' => $nome,
            'preco' => $preco,
            'quantidade' => ($carrinho[$produtoId]['quantidade'] ?? 0) + $quantidade,
        ];

        session()->set('carrinho', $carrinho);

        return redirect()->back()->with('sucesso', 'Produto adicionado ao carrinho.');
    }

    public function atualizar()
    {
        if (!$this->estaLogado()) {
            return redirect()->to(site_url('login/novo'))->with('atencao', 'Faça login para continuar o pedido.');
        }

        $post = $this->request->getPost();
        $carrinho = session('carrinho') ?? [];

        foreach ($post['quantidades'] ?? [] as $produtoId => $quantidade) {
            $quantidade = max(1, (int) $quantidade);
            if (isset($carrinho[$produtoId])) {
                $carrinho[$produtoId]['quantidade'] = $quantidade;
            }
        }

        session()->set('carrinho', $carrinho);

        return redirect()->back()->with('sucesso', 'Carrinho atualizado.');
    }

    public function remover()
    {
        if (!$this->estaLogado()) {
            return redirect()->to(site_url('login/novo'))->with('atencao', 'Faça login para continuar o pedido.');
        }

        $produtoId = (int) ($this->request->getPost('produto_id') ?? 0);
        $carrinho = session('carrinho') ?? [];

        if ($produtoId > 0 && isset($carrinho[$produtoId])) {
            unset($carrinho[$produtoId]);
            session()->set('carrinho', $carrinho);
            return redirect()->back()->with('sucesso', 'Produto removido do carrinho.');
        }

        return redirect()->back()->with('erro', 'Produto não encontrado.');
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
