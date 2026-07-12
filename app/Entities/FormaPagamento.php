<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class FormaPagamento extends Entity
{
    protected $dates = ['criado_em', 'atualizado_em', 'deletado_em'];
}
