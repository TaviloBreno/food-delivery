<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\DTOs\CategoriaDTO;
use App\Exceptions\CategoriaException;
use App\Interfaces\CategoriaServiceInterface;
use App\Traits\PaginacaoTrait;
use App\Traits\RespostasTrait;
use Config\Services;

class Categorias extends BaseController
{
    use PaginacaoTrait;
    use RespostasTrait;

    private CategoriaServiceInterface $categoriaService;

    public function __construct()
    {
        $this->categoriaService = Services::categoriaService();
    }

    public function index()
    {
        $perPage = $this->getPerPage($this->request);
        $page = $this->getPage($this->request);

        $resultado = $this->categoriaService->listar($perPage, $page);

        $data = [
            'titulo' => 'Listando as categorias',
            'categorias' => $resultado['categorias'],
            'pager' => $resultado['pager'],
            'perPage' => $resultado['perPage'],
            'total' => $resultado['total'],
        ];

        return view('Admin/Categorias/index', $data);
    }

    public function show($id = null)
    {
        try {
            $categoria = $this->categoriaService->buscar((int) $id);

            $data = [
                'titulo' => "Detalhando a categoria {$categoria->nome}",
                'categoria' => $categoria,
            ];

            return view('Admin/Categorias/show', $data);
        } catch (CategoriaException $e) {
            return $this->atencao($e->getMessage());
        }
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
            return $this->atencao('Método inválido.');
        }

        try {
            $post = $this->request->getPost();

            $this->validate($this->getValidationRules());

            $dto = CategoriaDTO::fromArray($post);
            $this->categoriaService->criar($dto);

            return $this->sucesso('Categoria criada com sucesso!', site_url('admin/categorias'));
        } catch (CategoriaException $e) {
            return $this->erro($e->getMessage())->withInput();
        }
    }

    public function editar($id = null)
    {
        try {
            $categoria = $this->categoriaService->buscar((int) $id);

            $data = [
                'titulo' => "Editando a categoria {$categoria->nome}",
                'categoria' => $categoria,
            ];

            return view('Admin/Categorias/editar', $data);
        } catch (CategoriaException $e) {
            return $this->atencao($e->getMessage());
        }
    }

    public function atualizar($id = null)
    {
        $method = strtolower($this->request->getMethod());

        if (!in_array($method, ['post', 'put'])) {
            return $this->atencao('Método inválido.');
        }

        try {
            $post = $this->request->getPost();

            $this->validate($this->getValidationRules((int) $id));

            $dto = CategoriaDTO::fromArray($post);
            $this->categoriaService->atualizar((int) $id, $dto);

            return $this->sucesso('Categoria atualizada com sucesso!', site_url("admin/categorias/show/{$id}"));
        } catch (CategoriaException $e) {
            return $this->erro($e->getMessage())->withInput();
        }
    }

    public function excluir($id = null)
    {
        try {
            $this->categoriaService->excluir((int) $id);

            return $this->sucesso('Categoria excluída com sucesso!', site_url('admin/categorias'));
        } catch (CategoriaException $e) {
            return $this->erro($e->getMessage());
        }
    }

    public function restaurar($id = null)
    {
        try {
            $this->categoriaService->restaurar((int) $id);

            return $this->sucesso('Categoria restaurada com sucesso!', site_url('admin/categorias'));
        } catch (CategoriaException $e) {
            return $this->erro($e->getMessage());
        }
    }

    public function procurar()
    {
        if (!$this->request->isAJAX()) {
            return $this->atencao('Requisição inválida.');
        }

        $term = $this->request->getGet('term');
        $categorias = $this->categoriaService->procurar($term);

        $retorno = array_map(
            fn($categoria) => ['id' => $categoria->id, 'value' => $categoria->nome],
            $categorias
        );

        return $this->response->setJSON($retorno);
    }

    private function getValidationRules(?int $id = null): array
    {
        $rules = [
            'nome' => 'required|min_length[3]|max_length[128]',
            'descricao' => 'permit_empty|max_length[500]',
            'icone' => 'permit_empty|max_length[50]',
            'ativo' => 'required|in_list[0,1]',
        ];

        if ($id) {
            $rules['nome'] = "required|min_length[3]|max_length[128]|is_unique[categorias.nome,id,{$id}]";
        }

        return $rules;
    }
}
