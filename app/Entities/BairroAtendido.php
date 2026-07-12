<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class BairroAtendido extends Entity
{
    protected $dates = ['criado_em', 'atualizado_em', 'deletado_em'];

    public function getStatusBadge()
    {
        if ($this->deletado_em !== null) {
            return '<span class="badge badge-danger">Excluído</span>';
        }

        if ($this->ativo == 0) {
            return '<span class="badge badge-warning">Inativo</span>';
        }

        return '<span class="badge badge-success">Ativo</span>';
    }

    public function getTaxaEntregaFormatada()
    {
        return 'R$ ' . number_format($this->taxa_entrega, 2, ',', '.');
    }
}
