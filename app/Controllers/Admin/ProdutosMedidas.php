<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdutoModel;
use App\Models\ProdutoMedidaModel;
use CodeIgniter\HTTP\RedirectResponse;

class ProdutosMedidas extends BaseController
{
    private ProdutoModel $produtoModel;
    private ProdutoMedidaModel $medidaModel;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
        $this->medidaModel = new ProdutoMedidaModel();
    }

    public function index($produtoId = null)
    {
        $produtoId = (int) $produtoId;
        $produto = $this->buscaProdutoOu404($produtoId);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $medidas = $this->medidaModel->listarPorProduto($produtoId);

        $data = [
            'titulo' => "Medidas do produto - {$produto->nome}",
            'produto' => $produto,
            'medidas' => $medidas,
        ];

        return view('Admin/Produtos/medidas', $data);
    }

    public function criar($produtoId = null)
    {
        $produtoId = (int) $produtoId;
        $produto = $this->buscaProdutoOu404($produtoId);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $data = [
            'titulo' => "Nova medida para {$produto->nome}",
            'produto' => $produto,
        ];

        return view('Admin/Produtos/criar_medida', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $post['preco'] = str_replace(',', '.', $post['preco']);

        if (!$this->validate($this->medidaModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'produto_id' => $post['produto_id'],
            'nome' => $post['nome'],
            'tamanho' => $post['tamanho'],
            'preco' => $post['preco'],
        ];

        if ($this->medidaModel->insert($dados)) {
            return redirect()->to(site_url("admin/produtos/medidas/{$post['produto_id']}"))
                ->with('sucesso', 'Medida criada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao criar medida')->withInput();
    }

    public function excluir($id = null)
    {
        $id = (int) $id;
        $medida = $this->medidaModel->find($id);

        if (!$medida) {
            return redirect()->back()->with('atencao', 'Medida não encontrada.');
        }

        $produtoId = $medida->produto_id;

        if ($this->medidaModel->delete($id)) {
            return redirect()->to(site_url("admin/produtos/medidas/{$produtoId}"))
                ->with('sucesso', 'Medida excluída com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao excluir medida');
    }

    private function buscaProdutoOu404(?int $id = null)
    {
        if (!$id || !$produto = $this->produtoModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Produto não encontrado');
        }

        return $produto;
    }
}
