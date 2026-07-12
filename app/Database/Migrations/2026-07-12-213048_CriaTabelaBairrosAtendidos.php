<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaBairrosAtendidos extends Migration
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
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'unique' => true,
            ],
            'cidade' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'default' => 'Crateús',
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
                'default' => 'CE',
            ],
            'taxa_entrega' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'tempo_medio' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 30,
                'comment' => 'Tempo médio de entrega em minutos',
            ],
            'ativo' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => true,
            ],
            'criado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'atualizado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deletado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('bairros_atendidos');
    }

    public function down()
    {
        $this->forge->dropTable('bairros_atendidos');
    }
}
