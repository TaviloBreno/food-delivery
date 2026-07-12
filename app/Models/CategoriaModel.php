<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table            = 'categorias';
    protected $returnType       = 'App\Entities\Categoria';
    protected $allowedFields    = ['nome', 'slug', 'descricao', 'icone', 'ativo'];

    protected $useSoftDelete    = true;
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';
    protected $deletedField     = 'deletado_em';

    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[128]|is_unique[categorias.nome,id,{id}]',
        'slug' => 'required|min_length[3]|max_length[128]|is_unique[categorias.slug,id,{id}]',
        'descricao' => 'permit_empty|max_length[500]',
        'icone' => 'permit_empty|max_length[50]',
        'ativo' => 'required|in_list[0,1]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O Nome deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Nome deve ter no máximo 128 caracteres.',
            'is_unique' => 'Esta categoria já existe.',
        ],
        'slug' => [
            'required' => 'O campo Slug é obrigatório.',
            'min_length' => 'O Slug deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Slug deve ter no máximo 128 caracteres.',
            'is_unique' => 'Este Slug já está em uso.',
        ],
        'ativo' => [
            'required' => 'Selecione o status da categoria.',
            'in_list' => 'Status inválido.',
        ],
    ];

    public function procurar(string $term): array
    {
        if (empty($term)) {
            return [];
        }

        return $this->select('id, nome')
            ->like('nome', $term)
            ->withDeleted(true)
            ->get()
            ->getResult();
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
}
