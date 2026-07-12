<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ExpedienteModel extends Model
{
    protected $table            = 'expedientes';
    protected $returnType       = 'App\Entities\Expediente';
    protected $allowedFields    = ['dia_semana', 'abertura', 'fechamento', 'intervalo_inicio', 'intervalo_fim', 'fechado'];

    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';

    protected $validationRules = [
        'dia_semana' => 'required|in_list[monday,tuesday,wednesday,thursday,friday,saturday,sunday]',
        'abertura' => 'permit_empty',
        'fechamento' => 'permit_empty',
        'intervalo_inicio' => 'permit_empty',
        'intervalo_fim' => 'permit_empty',
        'fechado' => 'required|in_list[0,1]',
    ];

    protected $validationMessages = [
        'dia_semana' => [
            'required' => 'O campo Dia da semana é obrigatório.',
            'in_list' => 'Dia da semana inválido.',
        ],
        'fechado' => [
            'required' => 'Selecione se o estabelecimento está fechado.',
            'in_list' => 'Status inválido.',
        ],
    ];

    public function getDiasSemana()
    {
        return [
            'monday' => 'Segunda-feira',
            'tuesday' => 'Terça-feira',
            'wednesday' => 'Quarta-feira',
            'thursday' => 'Quinta-feira',
            'friday' => 'Sexta-feira',
            'saturday' => 'Sábado',
            'sunday' => 'Domingo',
        ];
    }

    public function getHorarios()
    {
        $dias = $this->getDiasSemana();
        $resultados = [];

        foreach ($dias as $key => $nome) {
            $expediente = $this->where('dia_semana', $key)->first();

            if (!$expediente) {
                $expediente = $this->criarPadrao($key);
            }

            $resultados[$key] = $expediente;
        }

        return $resultados;
    }

    public function criarPadrao(string $dia)
    {
        $horarios = [
            'monday' => ['abertura' => '08:00', 'fechamento' => '22:00'],
            'tuesday' => ['abertura' => '08:00', 'fechamento' => '22:00'],
            'wednesday' => ['abertura' => '08:00', 'fechamento' => '22:00'],
            'thursday' => ['abertura' => '08:00', 'fechamento' => '22:00'],
            'friday' => ['abertura' => '08:00', 'fechamento' => '23:00'],
            'saturday' => ['abertura' => '09:00', 'fechamento' => '23:00'],
            'sunday' => ['abertura' => '09:00', 'fechamento' => '20:00'],
        ];

        $dados = [
            'dia_semana' => $dia,
            'abertura' => $horarios[$dia]['abertura'] ?? '08:00',
            'fechamento' => $horarios[$dia]['fechamento'] ?? '22:00',
            'intervalo_inicio' => null,
            'intervalo_fim' => null,
            'fechado' => 0,
        ];

        return (object) $dados;
    }
}
