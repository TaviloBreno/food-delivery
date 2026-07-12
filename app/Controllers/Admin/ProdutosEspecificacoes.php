<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdutoModel;
use App\Models\ProdutoEspecificacaoModel;
use CodeIgniter\HTTP\RedirectResponse;

class ProdutosEspecificacoes extends BaseController
{
    private ProdutoModel $produtoModel;
    private ProdutoEspecificacaoModel $especificacaoModel;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
        $this->especificacaoModel = new ProdutoEspecificacaoModel();
    }

    public function index($produtoId = null)
    {
        $produtoId = (int) $produtoId;
        $produto = $this->buscaProdutoOu404($produtoId);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $especificacoes = $this->especificacaoModel->listarPorProduto($produtoId);

        $data = [
            'titulo' => "Especificações do produto - {$produto->nome}",
            'produto' => $produto,
            'especificacoes' => $especificacoes,
        ];

        return view('Admin/Produtos/especificacoes', $data);
    }

    public function criar($produtoId = null)
    {
        $produtoId = (int) $produtoId;
        $produto = $this->buscaProdutoOu404($produtoId);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $data = [
            'titulo' => "Nova especificação para {$produto->nome}",
            'produto' => $produto,
        ];

        return view('Admin/Produtos/criar_especificacao', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        if (!$this->validate($this->especificacaoModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'produto_id' => $post['produto_id'],
            'nome' => $post['nome'],
            'valor' => $post['valor'],
        ];

        if ($this->especificacaoModel->insert($dados)) {
            return redirect()->to(site_url("admin/produtos/especificacoes/{$post['produto_id']}"))
                ->with('sucesso', 'Especificação criada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao criar especificação')->withInput();
    }

    public function excluir($id = null)
    {
        $id = (int) $id;
        $especificacao = $this->especificacaoModel->find($id);

        if (!$especificacao) {
            return redirect()->back()->with('atencao', 'Especificação não encontrada.');
        }

        $produtoId = $especificacao->produto_id;

        if ($this->especificacaoModel->delete($id)) {
            return redirect()->to(site_url("admin/produtos/especificacoes/{$produtoId}"))
                ->with('sucesso', 'Especificação excluída com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao excluir especificação');
    }

    private function buscaProdutoOu404(?int $id = null)
    {
        if (!$id || !$produto = $this->produtoModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Produto não encontrado');
        }

        return $produto;
    }
}
