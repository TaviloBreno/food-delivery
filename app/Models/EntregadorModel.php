<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class EntregadorModel extends Model
{
    protected $table            = 'entregadores';
    protected $returnType       = 'App\Entities\Entregador';
    protected $allowedFields    = [
        'nome',
        'email',
        'cpf',
        'telefone',
        'cnh',
        'placa_veiculo',
        'modelo_veiculo',
        'cor_veiculo',
        'foto',
        'ativo',
        'disponivel'
    ];

    protected $useSoftDelete    = true;
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';
    protected $deletedField     = 'deletado_em';

    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[128]',
        'email' => 'required|valid_email|is_unique[entregadores.email,id,{id}]',
        'cpf' => 'permit_empty|exact_length[11]|is_unique[entregadores.cpf,id,{id}]',
        'telefone' => 'required|min_length[10]|max_length[20]',
        'cnh' => 'permit_empty|max_length[20]',
        'placa_veiculo' => 'permit_empty|max_length[10]',
        'modelo_veiculo' => 'permit_empty|max_length[64]',
        'cor_veiculo' => 'permit_empty|max_length[32]',
        'ativo' => 'required|in_list[0,1]',
        'disponivel' => 'required|in_list[0,1]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O Nome deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Nome deve ter no máximo 128 caracteres.',
        ],
        'email' => [
            'required' => 'O campo E-mail é obrigatório.',
            'valid_email' => 'Digite um e-mail válido.',
            'is_unique' => 'Este e-mail já está cadastrado.',
        ],
        'cpf' => [
            'exact_length' => 'O CPF deve ter exatamente 11 números.',
            'is_unique' => 'Este CPF já está cadastrado.',
        ],
        'telefone' => [
            'required' => 'O campo Telefone é obrigatório.',
            'min_length' => 'O Telefone deve ter no mínimo 10 dígitos.',
            'max_length' => 'O Telefone deve ter no máximo 20 dígitos.',
        ],
        'ativo' => [
            'required' => 'Selecione o status do entregador.',
            'in_list' => 'Status inválido.',
        ],
        'disponivel' => [
            'required' => 'Selecione a disponibilidade do entregador.',
            'in_list' => 'Disponibilidade inválida.',
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

    public function softDelete(int $id): bool
    {
        return $this->update($id, ['deletado_em' => date('Y-m-d H:i:s')]);
    }

    public function softRestore(int $id): bool
    {
        return $this->update($id, ['deletado_em' => null]);
    }
}
