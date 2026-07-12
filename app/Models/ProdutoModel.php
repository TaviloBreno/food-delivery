<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table            = 'produtos';
    protected $returnType       = 'App\Entities\Produto';
    protected $allowedFields    = [
        'categoria_id',
        'nome',
        'slug',
        'descricao',
        'preco',
        'preco_promocional',
        'imagem',
        'ativo',
        'destaque'
    ];

    protected $useSoftDelete    = true;
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';
    protected $deletedField     = 'deletado_em';

    protected $validationRules = [
        'categoria_id' => 'required|is_not_unique[categorias.id]',
        'nome' => 'required|min_length[3]|max_length[128]|is_unique[produtos.nome,id,{id}]',
        'slug' => 'required|min_length[3]|max_length[128]|is_unique[produtos.slug,id,{id}]',
        'descricao' => 'permit_empty|max_length[500]',
        'preco' => 'required|numeric|greater_than[0]',
        'preco_promocional' => 'permit_empty|numeric|greater_than[0]',
        'ativo' => 'required|in_list[0,1]',
        'destaque' => 'required|in_list[0,1]',
    ];

    protected $validationMessages = [
        'categoria_id' => [
            'required' => 'Selecione uma categoria.',
            'is_not_unique' => 'Categoria inválida.',
        ],
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O Nome deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Nome deve ter no máximo 128 caracteres.',
            'is_unique' => 'Este produto já existe.',
        ],
        'slug' => [
            'required' => 'O campo Slug é obrigatório.',
            'min_length' => 'O Slug deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Slug deve ter no máximo 128 caracteres.',
            'is_unique' => 'Este Slug já está em uso.',
        ],
        'preco' => [
            'required' => 'O campo Preço é obrigatório.',
            'numeric' => 'O Preço deve ser um número.',
            'greater_than' => 'O Preço deve ser maior que zero.',
        ],
        'ativo' => [
            'required' => 'Selecione o status do produto.',
            'in_list' => 'Status inválido.',
        ],
    ];

    public function procurar(string $term): array
    {
        if (empty($term)) {
            return [];
        }

        return $this->select('produtos.id, produtos.nome, categorias.nome as categoria')
            ->join('categorias', 'categorias.id = produtos.categoria_id')
            ->like('produtos.nome', $term)
            ->withDeleted(true)
            ->get()
            ->getResult();
    }

    public function listarComCategoria()
    {
        return $this->select('produtos.*, categorias.nome as categoria_nome')
            ->join('categorias', 'categorias.id = produtos.categoria_id')
            ->withDeleted(true);
    }

    public function gerarSlug(string $texto): string
    {
        $texto = preg_replace('/[^a-zA-Z0-9]/', '-', $texto);
        $texto = strtolower($texto);
        $texto = preg_replace('/-+/', '-', $texto);
        return trim($texto, '-');
    }

    public function softDelete(int $id): bool
    {
        return $this->update($id, ['deletado_em' => date('Y-m-d H:i:s')]);
    }

    public function softRestore(int $id): bool
    {
        return $this->update($id, ['deletado_em' => null]);
    }

    public function getCategoriaNome(int $categoriaId): string
    {
        $categoriaModel = new CategoriaModel();
        $categoria = $categoriaModel->find($categoriaId);
        return $categoria ? $categoria->nome : 'N/A';
    }
}
