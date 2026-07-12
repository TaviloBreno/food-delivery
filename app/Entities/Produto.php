<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Produto extends Entity
{
    protected $dates = ['criado_em', 'atualizado_em', 'deletado_em'];

    public function getImagemUrl()
    {
        if (!empty($this->imagem) && filter_var($this->imagem, FILTER_VALIDATE_URL)) {
            return $this->imagem;
        }

        if (!empty($this->imagem)) {
            return site_url('admin/uploads/produtos/' . $this->imagem);
        }

        return site_url('admin/images/sem-imagem.jpg');
    }

    public function getImagemThumb()
    {
        $url = $this->getImagemUrl();

        if (strpos($url, 'unsplash.com') !== false) {
            return $url . '&w=100&h=100&fit=crop&crop=center';
        }

        return $url;
    }
}
