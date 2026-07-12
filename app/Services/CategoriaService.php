<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\CategoriaRepositoryInterface;
use App\Interfaces\CategoriaServiceInterface;
use App\Exceptions\CategoriaException;

class CategoriaService implements CategoriaServiceInterface
{
    private CategoriaRepositoryInterface $repository;

    public function __construct(CategoriaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function listar(int $perPage, ?int $page): array
    {
        $categorias = $this->repository->findAll($perPage, $page);
        $pager = $this->repository->getPager();
        $total = $this->repository->countAll();

        return compact('categorias', 'pager', 'total', 'perPage');
    }

    public function buscar(int $id): object
    {
        $categoria = $this->repository->findById($id);

        if (!$categoria) {
            throw CategoriaException::naoEncontrada($id);
        }

        return $categoria;
    }

    public function procurar(string $term): array
    {
        if (empty($term)) {
            return [];
        }

        return $this->repository->search($term);
    }

    public function criar(array $dados): array
    {
        $dados['slug'] = $this->gerarSlug($dados['nome']);

        $this->validarNomeUnico($dados['nome']);
        $this->validarSlugUnico($dados['slug']);

        $this->repository->create($dados);
        return ['success' => true, 'message' => 'Categoria criada com sucesso!'];
    }

    public function atualizar(int $id, array $dados): array
    {
        $this->validarCategoriaExiste($id);

        $dados['slug'] = $this->gerarSlug($dados['nome']);

        $this->validarNomeUnico($dados['nome'], $id);
        $this->validarSlugUnico($dados['slug'], $id);

        $this->repository->update($id, $dados);
        return ['success' => true, 'message' => 'Categoria atualizada com sucesso!'];
    }

    public function excluir(int $id): array
    {
        $categoria = $this->validarCategoriaExiste($id);

        if ($categoria->deletado_em !== null) {
            throw CategoriaException::jaExcluida();
        }

        $this->repository->softDelete($id);
        return ['success' => true, 'message' => 'Categoria excluída com sucesso!'];
    }

    public function restaurar(int $id): array
    {
        $categoria = $this->validarCategoriaExiste($id);

        if ($categoria->deletado_em === null) {
            throw CategoriaException::naoExcluida();
        }

        $this->repository->softRestore($id);
        return ['success' => true, 'message' => 'Categoria restaurada com sucesso!'];
    }

    public function gerarSlug(string $nome): string
    {
        $slug = preg_replace('/[^a-zA-Z0-9]/', '-', $nome);
        $slug = strtolower($slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return trim($slug, '-');
    }

    private function validarCategoriaExiste(int $id): object
    {
        $categoria = $this->repository->findById($id);

        if (!$categoria) {
            throw CategoriaException::naoEncontrada($id);
        }

        return $categoria;
    }

    private function validarNomeUnico(string $nome, ?int $id = null): void
    {
        $categoria = $this->repository->findBySlug($this->gerarSlug($nome));

        if ($categoria && (!$id || $categoria->id !== $id)) {
            throw CategoriaException::nomeJaExiste($nome);
        }
    }

    private function validarSlugUnico(string $slug, ?int $id = null): void
    {
        $categoria = $this->repository->findBySlug($slug);

        if ($categoria && (!$id || $categoria->id !== $id)) {
            throw CategoriaException::slugJaExiste($slug);
        }
    }
}
