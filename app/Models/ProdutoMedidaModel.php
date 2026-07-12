<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ProdutoMedidaModel extends Model
{
    protected $table            = 'produtos_medidas';
    protected $returnType       = 'App\Entities\ProdutoMedida';
    protected $allowedFields    = ['produto_id', 'nome', 'tamanho', 'preco'];
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';

    protected $validationRules = [
        'produto_id' => 'required|is_not_unique[produtos.id]',
        'nome' => 'required|min_length[2]|max_length[64]',
        'tamanho' => 'required|min_length[1]|max_length[32]',
        'preco' => 'required|numeric|greater_than[0]',
    ];

    protected $validationMessages = [
        'produto_id' => [
            'required' => 'Produto inválido.',
        ],
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O Nome deve ter no mínimo 2 caracteres.',
            'max_length' => 'O Nome deve ter no máximo 64 caracteres.',
        ],
        'tamanho' => [
            'required' => 'O campo Tamanho é obrigatório.',
            'min_length' => 'O Tamanho deve ter no mínimo 1 caractere.',
            'max_length' => 'O Tamanho deve ter no máximo 32 caracteres.',
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
