<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nome', 'email', 'telefone'];
    protected $useSoftDelete    = true;

    protected $useTimestamps    = true;
    protected $createdField      = 'criado_em';
    protected $updatedField      = 'atualizado_em';
    protected $deletedField      = 'deletado_em';

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
