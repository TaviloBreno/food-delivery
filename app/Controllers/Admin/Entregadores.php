<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EntregadorModel;
use CodeIgniter\HTTP\RedirectResponse;

class Entregadores extends BaseController
{
    private EntregadorModel $entregadorModel;

    public function __construct()
    {
        $this->entregadorModel = new EntregadorModel();
    }

    public function index()
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $perPage = in_array($perPage, [5, 10, 15]) ? (int) $perPage : 10;

        $page = $this->request->getGet('page');
        $page = is_numeric($page) ? (int) $page : null;

        $entregadores = $this->entregadorModel->withDeleted(true)
            ->paginate($perPage, 'default', $page);

        $pager = $this->entregadorModel->pager;

        $data = [
            'titulo' => 'Listando os entregadores',
            'entregadores' => $entregadores,
            'pager' => $pager,
            'perPage' => $perPage,
            'total' => $this->entregadorModel->withDeleted(true)->countAllResults(),
        ];

        return view('Admin/Entregadores/index', $data);
    }

    public function procurar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $term = $this->request->getGet('term');
        $entregadores = $this->entregadorModel->procurar($term);

        $retorno = [];
        foreach ($entregadores as $entregador) {
            $retorno[] = [
                'id' => $entregador->id,
                'value' => $entregador->nome,
            ];
        }

        return $this->response->setJSON($retorno);
    }

    public function show($id = null)
    {
        $id = (int) $id;
        $entregador = $this->buscaEntregadorOu404($id);

        if ($entregador instanceof RedirectResponse) {
            return $entregador;
        }

        $data = [
            'titulo' => "Detalhando o entregador {$entregador->nome}",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/show', $data);
    }

    public function criar()
    {
        $data = [
            'titulo' => 'Criar novo entregador',
        ];

        return view('Admin/Entregadores/criar', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $post['cpf'] = preg_replace('/\D/', '', $post['cpf'] ?? '');
        $post['telefone'] = preg_replace('/\D/', '', $post['telefone'] ?? '');

        if (!$this->validate($this->entregadorModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'nome' => $post['nome'],
            'email' => $post['email'],
            'cpf' => $post['cpf'],
            'telefone' => $post['telefone'],
            'cnh' => $post['cnh'] ?? null,
            'placa_veiculo' => $post['placa_veiculo'] ?? null,
            'modelo_veiculo' => $post['modelo_veiculo'] ?? null,
            'cor_veiculo' => $post['cor_veiculo'] ?? null,
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
            'disponivel' => isset($post['disponivel']) ? (int) $post['disponivel'] : 1,
        ];

        $this->entregadorModel->skipValidation(true);

        if ($this->entregadorModel->insert($dados)) {
            return redirect()->to(site_url('admin/entregadores'))
                ->with('sucesso', 'Entregador criado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao criar entregador')->withInput();
    }

    public function editar($id = null)
    {
        $id = (int) $id;
        $entregador = $this->buscaEntregadorOu404($id);

        if ($entregador instanceof RedirectResponse) {
            return $entregador;
        }

        $data = [
            'titulo' => "Editando o entregador {$entregador->nome}",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/editar', $data);
    }

    public function atualizar($id = null)
    {
        $method = strtolower($this->request->getMethod());

        if ($method !== 'post' && $method !== 'put') {
            return redirect()->back();
        }

        $id = (int) ($id ?: $this->request->getPost('id'));
        $entregador = $this->buscaEntregadorOu404($id);

        if ($entregador instanceof RedirectResponse) {
            return $entregador;
        }

        $post = $this->request->getPost();

        $post['cpf'] = preg_replace('/\D/', '', $post['cpf'] ?? '');
        $post['telefone'] = preg_replace('/\D/', '', $post['telefone'] ?? '');

        $rules = $this->entregadorModel->getValidationRules();
        $rules['email'] = "required|valid_email|is_unique[entregadores.email,id,{$id}]";
        $rules['cpf'] = "permit_empty|exact_length[11]|is_unique[entregadores.cpf,id,{$id}]";

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('atencao', 'Existem erros no formulário');
        }

        $dados = [
            'nome' => $post['nome'],
            'email' => $post['email'],
            'cpf' => $post['cpf'],
            'telefone' => $post['telefone'],
            'cnh' => $post['cnh'] ?? null,
            'placa_veiculo' => $post['placa_veiculo'] ?? null,
            'modelo_veiculo' => $post['modelo_veiculo'] ?? null,
            'cor_veiculo' => $post['cor_veiculo'] ?? null,
            'ativo' => isset($post['ativo']) ? (int) $post['ativo'] : 1,
            'disponivel' => isset($post['disponivel']) ? (int) $post['disponivel'] : 1,
        ];

        $this->entregadorModel->skipValidation(true);

        if ($this->entregadorModel->update($id, $dados)) {
            return redirect()->to(site_url("admin/entregadores/show/{$id}"))
                ->with('sucesso', 'Entregador atualizado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao atualizar entregador')->withInput();
    }

    public function excluir($id = null)
    {
        $id = (int) $id;
        $entregador = $this->buscaEntregadorOu404($id);

        if ($entregador instanceof RedirectResponse) {
            return $entregador;
        }

        if ($entregador->deletado_em !== null) {
            return redirect()->back()->with('atencao', 'Este entregador já está excluído.');
        }

        if ($this->entregadorModel->softDelete($id)) {
            return redirect()->to(site_url('admin/entregadores'))
                ->with('sucesso', 'Entregador excluído com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao excluir entregador');
    }

    public function restaurar($id = null)
    {
        $id = (int) $id;
        $entregador = $this->buscaEntregadorOu404($id);

        if ($entregador instanceof RedirectResponse) {
            return $entregador;
        }

        if ($entregador->deletado_em === null) {
            return redirect()->back()->with('atencao', 'Este entregador não está excluído.');
        }

        if ($this->entregadorModel->softRestore($id)) {
            return redirect()->to(site_url('admin/entregadores'))
                ->with('sucesso', 'Entregador restaurado com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao restaurar entregador');
    }

    public function uploadFoto($id = null)
    {
        $id = (int) $id;
        $entregador = $this->buscaEntregadorOu404($id);

        if ($entregador instanceof RedirectResponse) {
            return $entregador;
        }

        $data = [
            'titulo' => "Upload de foto - {$entregador->nome}",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/upload', $data);
    }

    public function salvarFoto($id = null)
    {
        $id = (int) $id;
        $entregador = $this->buscaEntregadorOu404($id);

        if ($entregador instanceof RedirectResponse) {
            return $entregador;
        }

        $foto = $this->request->getFile('foto');

        if (!$foto || !$foto->isValid()) {
            return redirect()->back()->with('atencao', 'Selecione uma foto válida.');
        }

        if ($foto->getSize() > 2097152) {
            return redirect()->back()->with('atencao', 'A foto deve ter no máximo 2MB.');
        }

        $extensao = $foto->getExtension();
        $nome = 'entregador_' . $entregador->id . '_' . time() . '.' . $extensao;

        $path = 'admin/uploads/entregadores/';
        $caminhoCompleto = FCPATH . $path;

        if (!is_dir($caminhoCompleto)) {
            mkdir($caminhoCompleto, 0777, true);
        }

        if ($foto->move($caminhoCompleto, $nome)) {
            if (!empty($entregador->foto) && file_exists($caminhoCompleto . $entregador->foto)) {
                unlink($caminhoCompleto . $entregador->foto);
            }

            $this->entregadorModel->update($id, ['foto' => $nome]);

            return redirect()->to(site_url("admin/entregadores/show/{$id}"))
                ->with('sucesso', 'Foto enviada com sucesso!');
        }

        return redirect()->back()->with('atencao', 'Erro ao enviar foto.')->withInput();
    }

    private function buscaEntregadorOu404(?int $id = null)
    {
        if (!$id || !$entregador = $this->entregadorModel->withDeleted(true)->find($id)) {
            return redirect()->back()->with('atencao', 'Entregador não encontrado');
        }

        return $entregador;
    }
}
