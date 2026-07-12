<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdutoModel;
use App\Models\CategoriaModel;
use CodeIgniter\HTTP\RedirectResponse;

class Produtos extends BaseController
{
    private ProdutoModel $produtoModel;
    private CategoriaModel $categoriaModel;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function index()
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $perPage = in_array($perPage, [5, 10, 15]) ? (int) $perPage : 10;

        $page = $this->request->getGet('page');
        $page = is_numeric($page) ? (int) $page : null;

        $produtos = $this->produtoModel->listarComCategoria()
            ->paginate($perPage, 'default', $page);

        $pager = $this->produtoModel->pager;

        $data = [
            'titulo' => 'Listando os produtos',
            'subtitulo' => 'Listagem completa dos produtos cadastrados',
            'produtos' => $produtos,
            'pager' => $pager,
            'perPage' => $perPage,
            'total' => $this->produtoModel->listarComCategoria()->countAllResults(),
        ];

        return view('Admin/Produtos/index', $data);
    }

    public function procurar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $term = $this->request->getGet('term');
        $produtos = $this->produtoModel->procurar($term);

        $retorno = [];
        foreach ($produtos as $produto) {
            $retorno[] = [
                'id' => $produto->id,
                'value' => $produto->nome,
                'label' => $produto->nome . ' (' . $produto->categoria . ')',
            ];
        }

        return $this->response->setJSON($retorno);
    }

    public function show($id = null)
    {
        $id = (int) $id;
        $produto = $this->buscaProdutoOu404($id);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $categoria = $this->categoriaModel->find($produto->categoria_id);
        $categoriaNome = $categoria ? $categoria->nome : 'N/A';

        $data = [
            'titulo' => "Detalhando o produto {$produto->nome}",
            'produto' => $produto,
            'categoria_nome' => $categoriaNome,
        ];

        return view('Admin/Produtos/show', $data);
    }

    public function criar()
    {
        $data = [
            'titulo' => 'Criar novo produto',
            'categorias' => $this->categoriaModel->where('ativo', 1)->findAll(),
        ];

        return view('Admin/Produtos/criar', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $post['slug'] = $this->produtoModel->gerarSlug($post['nome']);

        if (!$this->validate($this->produtoModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'categoria_id' => $post['categoria_id'],
            'nome' => $post['nome'],
            'slug' => $post['slug'],
            'descricao' => $post['descricao'] ?? null,
            'preco' => str_replace(',', '.', $post['preco']),
            'preco_promocional' => !empty($post['preco_promocional']) ? str_replace(',', '.', $post['preco_promocional']) : null,
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
            'destaque' => isset($post['destaque']) ? (int) $post['destaque'] : 0,
        ];

        $this->produtoModel->skipValidation(true);

        if ($this->produtoModel->insert($dados)) {
            return redirect()->to(site_url('admin/produtos'))->with('sucesso', 'Produto criado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao criar produto')->withInput();
    }

    public function editar($id = null)
    {
        $id = (int) $id;
        $produto = $this->buscaProdutoOu404($id);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $data = [
            'titulo' => "Editando o produto {$produto->nome}",
            'produto' => $produto,
            'categorias' => $this->categoriaModel->where('ativo', 1)->findAll(),
        ];

        return view('Admin/Produtos/editar', $data);
    }

    public function atualizar($id = null)
    {
        $method = strtolower($this->request->getMethod());

        if ($method !== 'post' && $method !== 'put') {
            return redirect()->back();
        }

        $id = (int) ($id ?: $this->request->getPost('id'));
        $produto = $this->buscaProdutoOu404($id);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $post = $this->request->getPost();

        $post['slug'] = $this->produtoModel->gerarSlug($post['nome']);

        $rules = $this->produtoModel->getValidationRules();
        $rules['nome'] = "required|min_length[3]|max_length[128]|is_unique[produtos.nome,id,{$id}]";
        $rules['slug'] = "required|min_length[3]|max_length[128]|is_unique[produtos.slug,id,{$id}]";

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'categoria_id' => $post['categoria_id'],
            'nome' => $post['nome'],
            'slug' => $post['slug'],
            'descricao' => $post['descricao'] ?? null,
            'preco' => str_replace(',', '.', $post['preco']),
            'preco_promocional' => !empty($post['preco_promocional']) ? str_replace(',', '.', $post['preco_promocional']) : null,
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
            'destaque' => isset($post['destaque']) ? (int) $post['destaque'] : 0,
        ];

        $this->produtoModel->skipValidation(true);

        if ($this->produtoModel->update($id, $dados)) {
            return redirect()->to(site_url("admin/produtos/show/{$id}"))->with('sucesso', 'Produto atualizado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao atualizar produto')->withInput();
    }

    public function excluir($id = null)
    {
        $id = (int) $id;
        $produto = $this->buscaProdutoOu404($id);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        if ($produto->deletado_em !== null) {
            return redirect()->back()->with('atencao', 'Este produto já está excluído.');
        }

        if ($this->produtoModel->softDelete($id)) {
            return redirect()->to(site_url('admin/produtos'))->with('sucesso', 'Produto excluído com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao excluir produto');
    }

    public function restaurar($id = null)
    {
        $id = (int) $id;
        $produto = $this->buscaProdutoOu404($id);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        if ($produto->deletado_em === null) {
            return redirect()->back()->with('atencao', 'Este produto não está excluído.');
        }

        if ($this->produtoModel->softRestore($id)) {
            return redirect()->to(site_url('admin/produtos'))->with('sucesso', 'Produto restaurado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao restaurar produto');
    }

    public function uploadImagem($id = null)
    {
        $id = (int) $id;
        $produto = $this->buscaProdutoOu404($id);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $data = [
            'titulo' => "Upload de imagem - {$produto->nome}",
            'produto' => $produto,
        ];

        return view('Admin/Produtos/upload', $data);
    }

    public function salvarImagem($id = null)
    {
        $id = (int) $id;
        $produto = $this->buscaProdutoOu404($id);

        if ($produto instanceof RedirectResponse) {
            return $produto;
        }

        $imagem = $this->request->getFile('imagem');

        if (!$imagem || !$imagem->isValid()) {
            return redirect()->back()->with('atencao', 'Selecione uma imagem válida.');
        }

        if ($imagem->getSize() > 2097152) {
            return redirect()->back()->with('atencao', 'A imagem deve ter no máximo 2MB.');
        }

        $extensao = $imagem->getExtension();
        $nome = 'produto_' . $produto->id . '_' . time() . '.' . $extensao;

        $path = 'admin/uploads/produtos/';
        $caminhoCompleto = FCPATH . $path;

        if (!is_dir($caminhoCompleto)) {
            mkdir($caminhoCompleto, 0777, true);
        }

        if ($imagem->move($caminhoCompleto, $nome)) {
            // Remover imagem antiga
            if (!empty($produto->imagem) && file_exists($caminhoCompleto . $produto->imagem)) {
                unlink($caminhoCompleto . $produto->imagem);
            }

            $this->produtoModel->update($id, ['imagem' => $nome]);

            return redirect()->to(site_url("admin/produtos/show/{$id}"))->with('sucesso', 'Imagem enviada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao enviar imagem.')->withInput();
    }

    private function buscaProdutoOu404(?int $id = null)
    {
        if (!$id || !$produto = $this->produtoModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Produto não encontrado');
        }

        return $produto;
    }
}
