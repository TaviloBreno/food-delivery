<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ExpedienteSeeder extends Seeder
{
    public function run()
    {
        $expedientes = [
            [
                'dia_semana' => 'monday',
                'abertura' => '08:00',
                'fechamento' => '22:00',
                'intervalo_inicio' => null,
                'intervalo_fim' => null,
                'fechado' => 0,
            ],
            [
                'dia_semana' => 'tuesday',
                'abertura' => '08:00',
                'fechamento' => '22:00',
                'intervalo_inicio' => null,
                'intervalo_fim' => null,
                'fechado' => 0,
            ],
            [
                'dia_semana' => 'wednesday',
                'abertura' => '08:00',
                'fechamento' => '22:00',
                'intervalo_inicio' => null,
                'intervalo_fim' => null,
                'fechado' => 0,
            ],
            [
                'dia_semana' => 'thursday',
                'abertura' => '08:00',
                'fechamento' => '22:00',
                'intervalo_inicio' => null,
                'intervalo_fim' => null,
                'fechado' => 0,
            ],
            [
                'dia_semana' => 'friday',
                'abertura' => '08:00',
                'fechamento' => '23:00',
                'intervalo_inicio' => null,
                'intervalo_fim' => null,
                'fechado' => 0,
            ],
            [
                'dia_semana' => 'saturday',
                'abertura' => '09:00',
                'fechamento' => '23:00',
                'intervalo_inicio' => null,
                'intervalo_fim' => null,
                'fechado' => 0,
            ],
            [
                'dia_semana' => 'sunday',
                'abertura' => '09:00',
                'fechamento' => '20:00',
                'intervalo_inicio' => null,
                'intervalo_fim' => null,
                'fechado' => 0,
            ],
        ];

        foreach ($expedientes as $expediente) {
            $this->db->table('expedientes')->insert($expediente);
        }

        echo "✅ Expediente criado com sucesso!\n";
    }
}
