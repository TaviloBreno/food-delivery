<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdutoModel;
use App\Models\ProdutoExtraModel;
use CodeIgniter\HTTP\RedirectResponse;

class ProdutosExtras extends BaseController
{
    private ProdutoModel $produtoModel;
    private ProdutoExtraModel $extraModel;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
        $this->extraModel = new ProdutoExtraModel();
    }

    public function index($produtoId = null)
    {
        $produtoId = (int) $produtoId;
        $produto = $this->buscaProdutoOu404($produtoId);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $extras = $this->extraModel->listarPorProduto($produtoId);

        $data = [
            'titulo' => "Extras do produto - {$produto->nome}",
            'produto' => $produto,
            'extras' => $extras,
        ];

        return view('Admin/Produtos/extras', $data);
    }

    public function criar($produtoId = null)
    {
        $produtoId = (int) $produtoId;
        $produto = $this->buscaProdutoOu404($produtoId);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $data = [
            'titulo' => "Novo extra para {$produto->nome}",
            'produto' => $produto,
        ];

        return view('Admin/Produtos/criar_extra', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $post['preco'] = str_replace(',', '.', $post['preco']);

        if (!$this->validate($this->extraModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'produto_id' => $post['produto_id'],
            'nome' => $post['nome'],
            'preco' => $post['preco'],
        ];

        if ($this->extraModel->insert($dados)) {
            return redirect()->to(site_url("admin/produtos/extras/{$post['produto_id']}"))
                ->with('sucesso', 'Extra criado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao criar extra')->withInput();
    }

    public function excluir($id = null)
    {
        $id = (int) $id;
        $extra = $this->extraModel->find($id);

        if (!$extra) {
            return redirect()->back()->with('atencao', 'Extra não encontrado.');
        }

        $produtoId = $extra->produto_id;

        if ($this->extraModel->delete($id)) {
            return redirect()->to(site_url("admin/produtos/extras/{$produtoId}"))
                ->with('sucesso', 'Extra excluído com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao excluir extra');
    }

    private function buscaProdutoOu404(?int $id = null)
    {
        if (!$id || !$produto = $this->produtoModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Produto não encontrado');
        }

        return $produto;
    }
}
