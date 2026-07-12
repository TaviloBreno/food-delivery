<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Produto extends Entity
{
    protected $dates = ['criado_em', 'atualizado_em', 'deletado_em'];

    public function getImagemUrl()
    {
        if (!empty($this->imagem)) {
            return site_url('admin/uploads/produtos/' . $this->imagem);
        }
        return site_url('admin/images/sem-imagem.jpg');
    }
}
