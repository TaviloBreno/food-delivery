<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class FormaPagamentoModel extends Model
{
    protected $table            = 'formas_pagamento';
    protected $returnType       = 'App\Entities\FormaPagamento';
    protected $allowedFields    = ['nome', 'slug', 'icone', 'descricao', 'taxa', 'parcelas', 'ativo'];

    protected $useSoftDelete    = true;
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';
    protected $deletedField     = 'deletado_em';

    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[64]|is_unique[formas_pagamento.nome,id,{id}]',
        'slug' => 'required|min_length[3]|max_length[64]|is_unique[formas_pagamento.slug,id,{id}]',
        'icone' => 'permit_empty|max_length[64]',
        'descricao' => 'permit_empty|max_length[255]',
        'taxa' => 'required|numeric|greater_than_equal[0]',
        'parcelas' => 'required|is_natural_no_zero',
        'ativo' => 'required|in_list[0,1]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O Nome deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Nome deve ter no máximo 64 caracteres.',
            'is_unique' => 'Esta forma de pagamento já existe.',
        ],
        'slug' => [
            'required' => 'O campo Slug é obrigatório.',
            'min_length' => 'O Slug deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Slug deve ter no máximo 64 caracteres.',
            'is_unique' => 'Este Slug já está em uso.',
        ],
        'taxa' => [
            'required' => 'O campo Taxa é obrigatório.',
            'numeric' => 'A Taxa deve ser um número.',
            'greater_than_equal' => 'A Taxa deve ser maior ou igual a zero.',
        ],
        'parcelas' => [
            'required' => 'O campo Parcelas é obrigatório.',
            'is_natural_no_zero' => 'O número de parcelas deve ser maior que zero.',
        ],
        'ativo' => [
            'required' => 'Selecione o status da forma de pagamento.',
            'in_list' => 'Status inválido.',
        ],
    ];

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
