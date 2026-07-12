<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BairroAtendidoModel;
use CodeIgniter\HTTP\RedirectResponse;

class BairrosAtendidos extends BaseController
{
    private BairroAtendidoModel $bairroModel;

    public function __construct()
    {
        $this->bairroModel = new BairroAtendidoModel();
    }

    public function index()
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $perPage = in_array($perPage, [5, 10, 15]) ? (int) $perPage : 10;

        $page = $this->request->getGet('page');
        $page = is_numeric($page) ? (int) $page : null;

        $bairros = $this->bairroModel->withDeleted(true)
            ->paginate($perPage, 'default', $page);

        $pager = $this->bairroModel->pager;

        $data = [
            'titulo' => 'Listando os bairros atendidos',
            'bairros' => $bairros,
            'pager' => $pager,
            'perPage' => $perPage,
            'total' => $this->bairroModel->withDeleted(true)->countAllResults(),
        ];

        return view('Admin/BairrosAtendidos/index', $data);
    }

    public function procurar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $term = $this->request->getGet('term');
        $bairros = $this->bairroModel->procurar($term);

        $retorno = [];
        foreach ($bairros as $bairro) {
            $retorno[] = [
                'id' => $bairro->id,
                'value' => $bairro->nome,
            ];
        }

        return $this->response->setJSON($retorno);
    }

    public function show($id = null)
    {
        $id = (int) $id;
        $bairro = $this->buscaBairroOu404($id);

        if ($bairro instanceof RedirectResponse) {
            return $bairro;
        }

        $data = [
            'titulo' => "Detalhando o bairro {$bairro->nome}",
            'bairro' => $bairro,
        ];

        return view('Admin/BairrosAtendidos/show', $data);
    }

    public function criar()
    {
        $data = [
            'titulo' => 'Criar novo bairro atendido',
        ];

        return view('Admin/BairrosAtendidos/criar', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $post['slug'] = $this->bairroModel->gerarSlug($post['nome']);
        $post['taxa_entrega'] = str_replace(',', '.', $post['taxa_entrega']);

        if (!$this->validate($this->bairroModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'nome' => $post['nome'],
            'slug' => $post['slug'],
            'cidade' => $post['cidade'] ?? 'Crateús',
            'estado' => $post['estado'] ?? 'CE',
            'taxa_entrega' => $post['taxa_entrega'],
            'tempo_medio' => $post['tempo_medio'] ?? 30,
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
        ];

        $this->bairroModel->skipValidation(true);

        if ($this->bairroModel->insert($dados)) {
            return redirect()->to(site_url('admin/bairros-atendidos'))
                ->with('sucesso', 'Bairro criado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao criar bairro')->withInput();
    }

    public function editar($id = null)
    {
        $id = (int) $id;
        $bairro = $this->buscaBairroOu404($id);

        if ($bairro instanceof RedirectResponse) {
            return $bairro;
        }

        $data = [
            'titulo' => "Editando o bairro {$bairro->nome}",
            'bairro' => $bairro,
        ];

        return view('Admin/BairrosAtendidos/editar', $data);
    }

    public function atualizar($id = null)
    {
        $method = strtolower($this->request->getMethod());

        if ($method !== 'post' && $method !== 'put') {
            return redirect()->back();
        }

        $id = (int) ($id ?: $this->request->getPost('id'));
        $bairro = $this->buscaBairroOu404($id);

        if ($bairro instanceof RedirectResponse) {
            return $bairro;
        }

        $post = $this->request->getPost();

        $post['slug'] = $this->bairroModel->gerarSlug($post['nome']);
        $post['taxa_entrega'] = str_replace(',', '.', $post['taxa_entrega']);

        $rules = $this->bairroModel->getValidationRules();
        $rules['nome'] = "required|min_length[3]|max_length[128]|is_unique[bairros_atendidos.nome,id,{$id}]";
        $rules['slug'] = "required|min_length[3]|max_length[128]|is_unique[bairros_atendidos.slug,id,{$id}]";

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'nome' => $post['nome'],
            'slug' => $post['slug'],
            'cidade' => $post['cidade'] ?? 'Crateús',
            'estado' => $post['estado'] ?? 'CE',
            'taxa_entrega' => $post['taxa_entrega'],
            'tempo_medio' => $post['tempo_medio'] ?? 30,
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
        ];

        $this->bairroModel->skipValidation(true);

        if ($this->bairroModel->update($id, $dados)) {
            return redirect()->to(site_url("admin/bairros-atendidos/show/{$id}"))
                ->with('sucesso', 'Bairro atualizado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao atualizar bairro')->withInput();
    }

    public function excluir($id = null)
    {
        $id = (int) $id;
        $bairro = $this->buscaBairroOu404($id);

        if ($bairro instanceof RedirectResponse) {
            return $bairro;
        }

        if ($bairro->deletado_em !== null) {
            return redirect()->back()->with('atencao', 'Este bairro já está excluído.');
        }

        if ($this->bairroModel->softDelete($id)) {
            return redirect()->to(site_url('admin/bairros-atendidos'))
                ->with('sucesso', 'Bairro excluído com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao excluir bairro');
    }

    public function restaurar($id = null)
    {
        $id = (int) $id;
        $bairro = $this->buscaBairroOu404($id);

        if ($bairro instanceof RedirectResponse) {
            return $bairro;
        }

        if ($bairro->deletado_em === null) {
            return redirect()->back()->with('atencao', 'Este bairro não está excluído.');
        }

        if ($this->bairroModel->softRestore($id)) {
            return redirect()->to(site_url('admin/bairros-atendidos'))
                ->with('sucesso', 'Bairro restaurado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao restaurar bairro');
    }

    private function buscaBairroOu404(?int $id = null)
    {
        if (!$id || !$bairro = $this->bairroModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Bairro não encontrado');
        }

        return $bairro;
    }
}
