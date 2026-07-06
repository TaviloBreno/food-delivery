<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nome', 'email', 'telefone'];
    protected $useSoftDelete    = true;

    protected $useTimestamps    = true;
    protected $createdField      = 'criado_em';
    protected $updatedField      = 'atualizado_em';
    protected $deletedField      = 'deletado_em';
}
