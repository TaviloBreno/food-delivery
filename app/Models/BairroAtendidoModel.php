<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class BairroAtendidoModel extends Model
{
    protected $table            = 'bairros_atendidos';
    protected $returnType       = 'App\Entities\BairroAtendido';
    protected $allowedFields    = ['nome', 'slug', 'cidade', 'estado', 'taxa_entrega', 'tempo_medio', 'ativo'];

    protected $useSoftDelete    = true;
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';
    protected $deletedField     = 'deletado_em';

    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[128]|is_unique[bairros_atendidos.nome,id,{id}]',
        'slug' => 'required|min_length[3]|max_length[128]|is_unique[bairros_atendidos.slug,id,{id}]',
        'cidade' => 'required|max_length[64]',
        'estado' => 'required|exact_length[2]',
        'taxa_entrega' => 'required|numeric|greater_than_equal[0]',
        'tempo_medio' => 'required|is_natural_no_zero',
        'ativo' => 'required|in_list[0,1]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome do bairro é obrigatório.',
            'min_length' => 'O Nome deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Nome deve ter no máximo 128 caracteres.',
            'is_unique' => 'Este bairro já está cadastrado.',
        ],
        'slug' => [
            'required' => 'O campo Slug é obrigatório.',
            'min_length' => 'O Slug deve ter no mínimo 3 caracteres.',
            'max_length' => 'O Slug deve ter no máximo 128 caracteres.',
            'is_unique' => 'Este Slug já está em uso.',
        ],
        'taxa_entrega' => [
            'required' => 'O campo Taxa de entrega é obrigatório.',
            'numeric' => 'A Taxa de entrega deve ser um número.',
            'greater_than_equal' => 'A Taxa de entrega deve ser maior ou igual a zero.',
        ],
        'tempo_medio' => [
            'required' => 'O campo Tempo médio é obrigatório.',
            'is_natural_no_zero' => 'O Tempo médio deve ser um número positivo.',
        ],
        'ativo' => [
            'required' => 'Selecione o status do bairro.',
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

    public function getBairrosAtivos()
    {
        return $this->where('ativo', 1)
            ->where('deletado_em', null)
            ->findAll();
    }
}
