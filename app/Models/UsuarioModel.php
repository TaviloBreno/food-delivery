<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';
    protected $allowedFields    = ['nome', 'email', 'telefone'];
    protected $useSoftDelete    = true;
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $createdField      = 'criado_em';
    protected $updatedField      = 'atualizado_em';
    protected $deletedField      = 'deletado_em';

    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[120]',
        'email' => 'required|valid_email|is_unique[usuarios.email,id,{id}]',
        'cpf' => 'required|exact_length[14]|is_unique[usuarios.cpf,id,{id}]',
        'telefone' => 'required|exact_length[15]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O campo Nome deve ter no mínimo 3 caracteres.',
            'max_length' => 'O campo Nome deve ter no máximo 120 caracteres.',
        ],
        'email' => [
            'required' => 'O campo E-mail é obrigatório.',
            'valid_email' => 'Por favor, forneça um endereço de e-mail válido.',
            'is_unique' => 'Este e-mail já está em uso. Por favor, escolha outro.',
        ],
        'cpf' => [
            'required' => 'O campo CPF é obrigatório.',
            'exact_length' => 'O campo CPF deve ter exatamente 14 caracteres.',
            'is_unique' => 'Este CPF já está em uso. Por favor, escolha outro.',
        ],
        'telefone' => [
            'required' => 'O campo Telefone é obrigatório.',
            'exact_length' => 'O campo Telefone deve ter exatamente 15 caracteres.',
        ],
    ];

    /**
     * Undocumented function
     *
     * @param string $term
     * @return array
     */
    public function procurar(string $term): array
    {
        if ($term === null) {
            return [];
        }

        return $this->select('id, nome')
            ->like('nome', $term)
            ->withDeleted(true)
            ->get()
            ->getResult();
    }
}
