<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracaoModel extends Model
{
    protected $table = 'configuracoes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'cidade',
        'endereco',
        'telefone',
        'horario_funcionamento',
        'sobre',
        'sobre_extra',
        'sobre_footer',
        'endereco_completo',
        'email',
        'whatsapp',
        'google_maps_api_key',
        'chave',
        'valor'
    ];
    protected $returnType = 'object';
    protected $useTimestamps = true;
}
