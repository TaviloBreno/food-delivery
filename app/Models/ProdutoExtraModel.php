<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ProdutoExtraModel extends Model
{
    protected $table            = 'produtos_extras';
    protected $returnType       = 'App\Entities\ProdutoExtra';
    protected $allowedFields    = ['produto_id', 'nome', 'preco'];
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';

    protected $validationRules = [
        'produto_id' => 'required|is_not_unique[produtos.id]',
        'nome' => 'required|min_length[3]|max_length[128]',
        'preco' => 'required|numeric|greater_than[0]',
    ];

    protected $validationMessages = [
        'produto_id' => [
            'required' => 'Produto inválido.',
        ],
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O Nome deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Nome deve ter no máximo 128 caracteres.',
        ],
        'preco' => [
            'required' => 'O campo Preço é obrigatório.',
            'numeric' => 'O Preço deve ser um número.',
            'greater_than' => 'O Preço deve ser maior que zero.',
        ],
    ];

    public function listarPorProduto(int $produtoId)
    {
        return $this->where('produto_id', $produtoId)->findAll();
    }
}
