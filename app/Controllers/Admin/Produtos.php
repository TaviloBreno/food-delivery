<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\DTOs\ProdutoDTO;
use App\Exceptions\ProdutoException;
use App\Interfaces\ProdutoServiceInterface;
use App\Traits\PaginacaoTrait;
use App\Traits\RespostasTrait;
use Config\Services;

class Produtos extends BaseController
{
    use PaginacaoTrait;
    use RespostasTrait;

    private ProdutoServiceInterface $produtoService;

    public function __construct()
    {
        $this->produtoService = Services::produtoService();
    }

    public function index()
    {
        $perPage = $this->getPerPage($this->request);
        $page = $this->getPage($this->request);

        $resultado = $this->produtoService->listar($perPage, $page);

        $data = [
            'titulo' => 'Listando os produtos',
            'subtitulo' => 'Listagem completa dos produtos cadastrados',
            'produtos' => $resultado['produtos'],
            'pager' => $resultado['pager'],
            'perPage' => $resultado['perPage'],
            'total' => $resultado['total'],
        ];

        return view('Admin/Produtos/index', $data);
    }

    public function procurar()
    {
        if (!$this->request->isAJAX()) {
            return $this->atencao('Requisição inválida.');
        }

        $term = $this->request->getGet('term');
        $produtos = $this->produtoService->procurar($term);

        $retorno = array_map(
            fn($produto) => [
                'id' => $produto->id,
                'value' => $produto->nome,
                'label' => $produto->nome . ' (' . $produto->categoria . ')',
            ],
            $produtos
        );

        return $this->response->setJSON($retorno);
    }

    public function show($id = null)
    {
        try {
            $produto = $this->produtoService->buscar((int) $id);

            $categoriaNome = $this->produtoService->getCategoriaNome($produto->categoria_id);

            $data = [
                'titulo' => "Detalhando o produto {$produto->nome}",
                'produto' => $produto,
                'categoria_nome' => $categoriaNome,
            ];

            return view('Admin/Produtos/show', $data);
        } catch (ProdutoException $e) {
            return $this->atencao($e->getMessage());
        }
    }

    public function criar()
    {
        $data = [
            'titulo' => 'Criar novo produto',
            'categorias' => $this->produtoService->getCategoriasAtivas(),
        ];

        return view('Admin/Produtos/criar', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return $this->atencao('Método inválido.');
        }

        try {
            $post = $this->request->getPost();

            $this->validate($this->getValidationRules());

            $dto = ProdutoDTO::fromArray($post);
            $this->produtoService->criar($dto);

            return $this->sucesso('Produto criado com sucesso!', site_url('admin/produtos'));
        } catch (ProdutoException $e) {
            return $this->erro($e->getMessage())->withInput();
        }
    }

    public function editar($id = null)
    {
        try {
            $produto = $this->produtoService->buscar((int) $id);

            $data = [
                'titulo' => "Editando o produto {$produto->nome}",
                'produto' => $produto,
                'categorias' => $this->produtoService->getCategoriasAtivas(),
            ];

            return view('Admin/Produtos/editar', $data);
        } catch (ProdutoException $e) {
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

            $dto = ProdutoDTO::fromArray($post);
            $this->produtoService->atualizar((int) $id, $dto);

            return $this->sucesso('Produto atualizado com sucesso!', site_url("admin/produtos/show/{$id}"));
        } catch (ProdutoException $e) {
            return $this->erro($e->getMessage())->withInput();
        }
    }

    public function excluir($id = null)
    {
        try {
            $this->produtoService->excluir((int) $id);

            return $this->sucesso('Produto excluído com sucesso!', site_url('admin/produtos'));
        } catch (ProdutoException $e) {
            return $this->erro($e->getMessage());
        }
    }

    public function restaurar($id = null)
    {
        try {
            $this->produtoService->restaurar((int) $id);

            return $this->sucesso('Produto restaurado com sucesso!', site_url('admin/produtos'));
        } catch (ProdutoException $e) {
            return $this->erro($e->getMessage());
        }
    }

    public function uploadImagem($id = null)
    {
        try {
            $produto = $this->produtoService->buscar((int) $id);

            $data = [
                'titulo' => "Upload de imagem - {$produto->nome}",
                'produto' => $produto,
            ];

            return view('Admin/Produtos/upload', $data);
        } catch (ProdutoException $e) {
            return $this->atencao($e->getMessage());
        }
    }

    public function salvarImagem($id = null)
    {
        if (!$this->request->is('post')) {
            return $this->atencao('Método inválido.');
        }

        try {
            $imagem = $this->request->getFile('imagem');
            $this->produtoService->salvarImagem((int) $id, $imagem);

            return $this->sucesso('Imagem enviada com sucesso!', site_url("admin/produtos/show/{$id}"));
        } catch (ProdutoException $e) {
            return $this->erro($e->getMessage());
        }
    }

    private function getValidationRules(?int $id = null): array
    {
        $rules = [
            'categoria_id' => 'required|is_not_unique[categorias.id]',
            'nome' => 'required|min_length[3]|max_length[128]',
            'descricao' => 'permit_empty|max_length[500]',
            'preco' => 'required|numeric|greater_than[0]',
            'preco_promocional' => 'permit_empty|numeric|greater_than[0]',
            'ativo' => 'required|in_list[0,1]',
            'destaque' => 'required|in_list[0,1]',
        ];

        if ($id) {
            $rules['nome'] = "required|min_length[3]|max_length[128]|is_unique[produtos.nome,id,{$id}]";
        }

        return $rules;
    }
}
