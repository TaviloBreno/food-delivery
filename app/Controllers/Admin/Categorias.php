<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use CodeIgniter\HTTP\RedirectResponse;

class Categorias extends BaseController
{
    private CategoriaModel $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new CategoriaModel();
    }

    public function index()
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $perPage = in_array($perPage, [5, 10, 15]) ? (int) $perPage : 10;

        $page = $this->request->getGet('page');
        $page = is_numeric($page) ? (int) $page : null;

        $categorias = $this->categoriaModel->withDeleted(true)->paginate($perPage, 'default', $page);
        $pager = $this->categoriaModel->pager;

        $data = [
            'titulo' => 'Listando as categorias',
            'categorias' => $categorias,
            'pager' => $pager,
            'perPage' => $perPage,
            'total' => $this->categoriaModel->withDeleted(true)->countAllResults(),
        ];

        return view('Admin/Categorias/index', $data);
    }

    public function show($id = null)
    {
        $id = (int) $id;
        $categoria = $this->buscaCategoriaOu404($id);

        if ($categoria instanceof RedirectResponse) {
            return $categoria;
        }

        $data = [
            'titulo' => "Detalhando a categoria {$categoria->nome}",
            'categoria' => $categoria,
        ];

        return view('Admin/Categorias/show', $data);
    }

    public function criar()
    {
        $data = [
            'titulo' => 'Criar nova categoria',
        ];

        return view('Admin/Categorias/criar', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $post['slug'] = $this->categoriaModel->gerarSlug($post['nome']);

        if (!$this->validate($this->categoriaModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'nome' => $post['nome'],
            'slug' => $post['slug'],
            'descricao' => $post['descricao'] ?? null,
            'icone' => $post['icone'] ?? null,
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
        ];

        $this->categoriaModel->skipValidation(true);

        if ($this->categoriaModel->insert($dados)) {
            return redirect()->to(site_url('admin/categorias'))->with('sucesso', 'Categoria criada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao criar categoria')->withInput();
    }

    public function editar($id = null)
    {
        $id = (int) $id;
        $categoria = $this->buscaCategoriaOu404($id);

        if ($categoria instanceof RedirectResponse) {
            return $categoria;
        }

        $data = [
            'titulo' => "Editando a categoria {$categoria->nome}",
            'categoria' => $categoria,
        ];

        return view('Admin/Categorias/editar', $data);
    }

    public function atualizar($id = null)
    {
        $method = strtolower($this->request->getMethod());

        if ($method !== 'post' && $method !== 'put') {
            return redirect()->back();
        }

        $id = (int) ($id ?: $this->request->getPost('id'));
        $categoria = $this->buscaCategoriaOu404($id);

        if ($categoria instanceof RedirectResponse) {
            return $categoria;
        }

        $post = $this->request->getPost();

        $post['slug'] = $this->categoriaModel->gerarSlug($post['nome']);

        $rules = $this->categoriaModel->getValidationRules();
        $rules['nome'] = "required|min_length[3]|max_length[128]|is_unique[categorias.nome,id,{$id}]";
        $rules['slug'] = "required|min_length[3]|max_length[128]|is_unique[categorias.slug,id,{$id}]";

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'nome' => $post['nome'],
            'slug' => $post['slug'],
            'descricao' => $post['descricao'] ?? null,
            'icone' => $post['icone'] ?? null,
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
        ];

        $this->categoriaModel->skipValidation(true);

        if ($this->categoriaModel->update($id, $dados)) {
            return redirect()->to(site_url("admin/categorias/show/{$id}"))->with('sucesso', 'Categoria atualizada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao atualizar categoria')->withInput();
    }

    public function excluir($id = null)
    {
        $id = (int) $id;
        $categoria = $this->buscaCategoriaOu404($id);

        if ($categoria instanceof RedirectResponse) {
            return $categoria;
        }

        if ($categoria->deletado_em !== null) {
            return redirect()->back()->with('atencao', 'Esta categoria já está excluída.');
        }

        if ($this->categoriaModel->softDelete($id)) {
            return redirect()->to(site_url('admin/categorias'))->with('sucesso', 'Categoria excluída com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao excluir categoria');
    }

    public function restaurar($id = null)
    {
        $id = (int) $id;
        $categoria = $this->buscaCategoriaOu404($id);

        if ($categoria instanceof RedirectResponse) {
            return $categoria;
        }

        if ($categoria->deletado_em === null) {
            return redirect()->back()->with('atencao', 'Esta categoria não está excluída.');
        }

        if ($this->categoriaModel->softRestore($id)) {
            return redirect()->to(site_url('admin/categorias'))->with('sucesso', 'Categoria restaurada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao restaurar categoria');
    }

    public function procurar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $term = $this->request->getGet('term');

        if (empty($term)) {
            return $this->response->setJSON([]);
        }

        $categorias = $this->categoriaModel
            ->select('id, nome')
            ->like('nome', $term)
            ->withDeleted(true)
            ->get()
            ->getResult();

        $retorno = [];
        foreach ($categorias as $categoria) {
            $retorno[] = [
                'id' => $categoria->id,
                'value' => $categoria->nome,
            ];
        }

        return $this->response->setJSON($retorno);
    }

    private function buscaCategoriaOu404(?int $id = null)
    {
        if (!$id || !$categoria = $this->categoriaModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Categoria não encontrada');
        }

        return $categoria;
    }
}
