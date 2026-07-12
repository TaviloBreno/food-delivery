<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Entregador extends Entity
{
    protected $dates = ['criado_em', 'atualizado_em', 'deletado_em'];

    public function getFotoUrl()
    {
        if (!empty($this->foto) && filter_var($this->foto, FILTER_VALIDATE_URL)) {
            return $this->foto;
        }

        if (!empty($this->foto)) {
            return site_url('admin/uploads/entregadores/' . $this->foto);
        }

        return site_url('admin/images/entregador-padrao.jpg');
    }

    public function getStatusBadge()
    {
        if ($this->deletado_em !== null) {
            return '<span class="badge badge-danger">Excluído</span>';
        }

        if ($this->ativo == 0) {
            return '<span class="badge badge-warning">Inativo</span>';
        }

        if ($this->disponivel == 0) {
            return '<span class="badge badge-secondary">Indisponível</span>';
        }

        return '<span class="badge badge-success">Disponível</span>';
    }
}
