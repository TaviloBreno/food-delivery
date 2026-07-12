<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FormaPagamentoModel;
use CodeIgniter\HTTP\RedirectResponse;

class FormasPagamento extends BaseController
{
    private FormaPagamentoModel $formaPagamentoModel;

    public function __construct()
    {
        $this->formaPagamentoModel = new FormaPagamentoModel();
    }

    public function index()
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $perPage = in_array($perPage, [5, 10, 15]) ? (int) $perPage : 10;

        $page = $this->request->getGet('page');
        $page = is_numeric($page) ? (int) $page : null;

        $formas = $this->formaPagamentoModel->withDeleted(true)
            ->paginate($perPage, 'default', $page);

        $pager = $this->formaPagamentoModel->pager;

        $data = [
            'titulo' => 'Listando as formas de pagamento',
            'formas' => $formas,
            'pager' => $pager,
            'perPage' => $perPage,
            'total' => $this->formaPagamentoModel->withDeleted(true)->countAllResults(),
        ];

        return view('Admin/FormasPagamento/index', $data);
    }

    public function show($id = null)
    {
        $id = (int) $id;
        $forma = $this->buscaFormaOu404($id);

        if ($forma instanceof RedirectResponse) {
            return $forma;
        }

        $data = [
            'titulo' => "Detalhando a forma de pagamento {$forma->nome}",
            'forma' => $forma,
        ];

        return view('Admin/FormasPagamento/show', $data);
    }

    public function criar()
    {
        $data = [
            'titulo' => 'Criar nova forma de pagamento',
        ];

        return view('Admin/FormasPagamento/criar', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $post['slug'] = $this->formaPagamentoModel->gerarSlug($post['nome']);
        $post['taxa'] = str_replace(',', '.', $post['taxa']);

        if (!$this->validate($this->formaPagamentoModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'nome' => $post['nome'],
            'slug' => $post['slug'],
            'icone' => $post['icone'] ?? null,
            'descricao' => $post['descricao'] ?? null,
            'taxa' => $post['taxa'],
            'parcelas' => $post['parcelas'],
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
        ];

        $this->formaPagamentoModel->skipValidation(true);

        if ($this->formaPagamentoModel->insert($dados)) {
            return redirect()->to(site_url('admin/formas-pagamento'))
                ->with('sucesso', 'Forma de pagamento criada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao criar forma de pagamento')->withInput();
    }

    public function editar($id = null)
    {
        $id = (int) $id;
        $forma = $this->buscaFormaOu404($id);

        if ($forma instanceof RedirectResponse) {
            return $forma;
        }

        $data = [
            'titulo' => "Editando a forma de pagamento {$forma->nome}",
            'forma' => $forma,
        ];

        return view('Admin/FormasPagamento/editar', $data);
    }

    public function atualizar($id = null)
    {
        $method = strtolower($this->request->getMethod());

        if ($method !== 'post' && $method !== 'put') {
            return redirect()->back();
        }

        $id = (int) ($id ?: $this->request->getPost('id'));
        $forma = $this->buscaFormaOu404($id);

        if ($forma instanceof RedirectResponse) {
            return $forma;
        }

        $post = $this->request->getPost();

        $post['slug'] = $this->formaPagamentoModel->gerarSlug($post['nome']);
        $post['taxa'] = str_replace(',', '.', $post['taxa']);

        $rules = $this->formaPagamentoModel->getValidationRules();
        $rules['nome'] = "required|min_length[3]|max_length[64]|is_unique[formas_pagamento.nome,id,{$id}]";
        $rules['slug'] = "required|min_length[3]|max_length[64]|is_unique[formas_pagamento.slug,id,{$id}]";

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'nome' => $post['nome'],
            'slug' => $post['slug'],
            'icone' => $post['icone'] ?? null,
            'descricao' => $post['descricao'] ?? null,
            'taxa' => $post['taxa'],
            'parcelas' => $post['parcelas'],
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
        ];

        $this->formaPagamentoModel->skipValidation(true);

        if ($this->formaPagamentoModel->update($id, $dados)) {
            return redirect()->to(site_url("admin/formas-pagamento/show/{$id}"))
                ->with('sucesso', 'Forma de pagamento atualizada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao atualizar forma de pagamento')->withInput();
    }

    public function excluir($id = null)
    {
        $id = (int) $id;
        $forma = $this->buscaFormaOu404($id);

        if ($forma instanceof RedirectResponse) {
            return $forma;
        }

        if ($forma->deletado_em !== null) {
            return redirect()->back()->with('atencao', 'Esta forma de pagamento já está excluída.');
        }

        if ($this->formaPagamentoModel->softDelete($id)) {
            return redirect()->to(site_url('admin/formas-pagamento'))
                ->with('sucesso', 'Forma de pagamento excluída com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao excluir forma de pagamento');
    }

    public function restaurar($id = null)
    {
        $id = (int) $id;
        $forma = $this->buscaFormaOu404($id);

        if ($forma instanceof RedirectResponse) {
            return $forma;
        }

        if ($forma->deletado_em === null) {
            return redirect()->back()->with('atencao', 'Esta forma de pagamento não está excluída.');
        }

        if ($this->formaPagamentoModel->softRestore($id)) {
            return redirect()->to(site_url('admin/formas-pagamento'))
                ->with('sucesso', 'Forma de pagamento restaurada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao restaurar forma de pagamento');
    }

    private function buscaFormaOu404(?int $id = null)
    {
        if (!$id || !$forma = $this->formaPagamentoModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Forma de pagamento não encontrada');
        }

        return $forma;
    }
}
