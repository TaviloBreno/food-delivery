<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Categoria extends Entity
{
    protected $dates = ['criado_em', 'atualizado_em', 'deletado_em'];
}
