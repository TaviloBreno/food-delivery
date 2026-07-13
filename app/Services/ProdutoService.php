<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\ProdutoDTO;
use App\Exceptions\ProdutoException;
use App\Interfaces\ProdutoRepositoryInterface;
use App\Interfaces\ProdutoServiceInterface;
use App\Models\CategoriaModel;

class ProdutoService implements ProdutoServiceInterface
{
    private ProdutoRepositoryInterface $repository;
    private CategoriaModel $categoriaModel;

    public function __construct(ProdutoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->categoriaModel = new CategoriaModel();
    }

    public function listar(int $perPage, ?int $page): array
    {
        $produtos = $this->repository->listarComCategoria()
            ->paginate($perPage, 'default', $page);
        $pager = $this->repository->getPager();
        $total = $this->repository->listarComCategoria()->countAllResults();

        return compact('produtos', 'pager', 'total', 'perPage');
    }

    public function buscar(int $id): object
    {
        $produto = $this->repository->findById($id);

        if (!$produto) {
            throw ProdutoException::naoEncontrado($id);
        }

        return $produto;
    }

    public function procurar(string $term): array
    {
        if (empty($term)) {
            return [];
        }

        return $this->repository->search($term);
    }

    public function criar(ProdutoDTO $dto): array
    {
        $slug = $this->gerarSlug($dto->nome);
        $dados = $dto->toArray();
        $dados['slug'] = $slug;

        $this->validarNomeUnico($dados['nome']);
        $this->validarSlugUnico($slug);

        $this->repository->create($dados);
        return ['success' => true, 'message' => 'Produto criado com sucesso!'];
    }

    public function atualizar(int $id, ProdutoDTO $dto): array
    {
        $this->validarProdutoExiste($id);

        $slug = $this->gerarSlug($dto->nome);
        $dados = $dto->toArray();
        $dados['slug'] = $slug;

        $this->validarNomeUnico($dados['nome'], $id);
        $this->validarSlugUnico($slug, $id);

        $this->repository->update($id, $dados);
        return ['success' => true, 'message' => 'Produto atualizado com sucesso!'];
    }

    public function excluir(int $id): array
    {
        $produto = $this->validarProdutoExiste($id);

        if ($produto->deletado_em !== null) {
            throw ProdutoException::jaExcluido();
        }

        $this->repository->softDelete($id);
        return ['success' => true, 'message' => 'Produto excluído com sucesso!'];
    }

    public function restaurar(int $id): array
    {
        $produto = $this->validarProdutoExiste($id);

        if ($produto->deletado_em === null) {
            throw ProdutoException::naoExcluido();
        }

        $this->repository->softRestore($id);
        return ['success' => true, 'message' => 'Produto restaurado com sucesso!'];
    }

    public function salvarImagem(int $id, object $imagem): array
    {
        $produto = $this->validarProdutoExiste($id);

        if (!$imagem->isValid()) {
            throw ProdutoException::imagemInvalida();
        }

        if ($imagem->getSize() > 2097152) {
            throw ProdutoException::imagemMuitoGrande();
        }

        $extensao = $imagem->getExtension();
        $nome = 'produto_' . $id . '_' . time() . '.' . $extensao;

        $path = 'admin/uploads/produtos/';
        $caminhoCompleto = FCPATH . $path;

        if (!is_dir($caminhoCompleto)) {
            mkdir($caminhoCompleto, 0777, true);
        }

        if ($imagem->move($caminhoCompleto, $nome)) {
            if (!empty($produto->imagem) && file_exists($caminhoCompleto . $produto->imagem)) {
                unlink($caminhoCompleto . $produto->imagem);
            }

            $this->repository->update($id, ['imagem' => $nome]);
            return ['success' => true, 'message' => 'Imagem enviada com sucesso!'];
        }

        throw ProdutoException::erroUploadImagem();
    }

    public function gerarSlug(string $nome): string
    {
        $slug = preg_replace('/[^a-zA-Z0-9]/', '-', $nome);
        $slug = strtolower($slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return trim($slug, '-');
    }

    public function getCategoriasAtivas(): array
    {
        return $this->categoriaModel->where('ativo', 1)->findAll();
    }

    private function validarProdutoExiste(int $id): object
    {
        $produto = $this->repository->findById($id);

        if (!$produto) {
            throw ProdutoException::naoEncontrado($id);
        }

        return $produto;
    }

    private function validarNomeUnico(string $nome, ?int $id = null): void
    {
        $slug = $this->gerarSlug($nome);
        $produto = $this->repository->findBySlug($slug);

        if ($produto && (!$id || $produto->id !== $id)) {
            throw ProdutoException::nomeJaExiste($nome);
        }
    }

    private function validarSlugUnico(string $slug, ?int $id = null): void
    {
        $produto = $this->repository->findBySlug($slug);

        if ($produto && (!$id || $produto->id !== $id)) {
            throw ProdutoException::slugJaExiste($slug);
        }
    }
}
