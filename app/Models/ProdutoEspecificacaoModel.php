<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ProdutoEspecificacaoModel extends Model
{
    protected $table            = 'produtos_especificacoes';
    protected $returnType       = 'App\Entities\ProdutoEspecificacao';
    protected $allowedFields    = ['produto_id', 'nome', 'valor'];
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';

    protected $validationRules = [
        'produto_id' => 'required|is_not_unique[produtos.id]',
        'nome' => 'required|min_length[3]|max_length[128]',
        'valor' => 'required|min_length[1]|max_length[128]',
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
        'valor' => [
            'required' => 'O campo Valor é obrigatório.',
            'min_length' => 'O Valor deve ter no mínimo 1 caractere.',
            'max_length' => 'O Valor deve ter no máximo 128 caracteres.',
        ],
    ];

    public function listarPorProduto(int $produtoId)
    {
        return $this->where('produto_id', $produtoId)->findAll();
    }
}
