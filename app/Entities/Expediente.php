<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Expediente extends Entity
{
    protected $dates = ['criado_em', 'atualizado_em'];

    public function getDiaSemanaNome()
    {
        $dias = [
            'monday' => 'Segunda-feira',
            'tuesday' => 'Terça-feira',
            'wednesday' => 'Quarta-feira',
            'thursday' => 'Quinta-feira',
            'friday' => 'Sexta-feira',
            'saturday' => 'Sábado',
            'sunday' => 'Domingo',
        ];

        return $dias[$this->dia_semana] ?? $this->dia_semana;
    }

    public function getHorarioFormatado()
    {
        if ($this->fechado) {
            return '<span class="badge badge-danger">Fechado</span>';
        }

        $horario = date('H:i', strtotime($this->abertura)) . ' - ' . date('H:i', strtotime($this->fechamento));

        if ($this->intervalo_inicio && $this->intervalo_fim) {
            $horario .= ' <span class="text-muted">(Intervalo: ' . date('H:i', strtotime($this->intervalo_inicio)) . ' - ' . date('H:i', strtotime($this->intervalo_fim)) . ')</span>';
        }

        return $horario;
    }

    public function getStatusBadge()
    {
        if ($this->fechado) {
            return '<span class="badge badge-danger">Fechado</span>';
        }

        return '<span class="badge badge-success">Aberto</span>';
    }
}
