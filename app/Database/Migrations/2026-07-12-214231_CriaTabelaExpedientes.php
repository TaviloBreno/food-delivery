<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaExpedientes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'dia_semana' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'abertura' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'fechamento' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'intervalo_inicio' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'intervalo_fim' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'fechado' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false,
            ],
            'criado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'atualizado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('expedientes');
    }

    public function down()
    {
        $this->forge->dropTable('expedientes');
    }
}
