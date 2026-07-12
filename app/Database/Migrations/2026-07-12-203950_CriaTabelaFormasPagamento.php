<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaFormasPagamento extends Migration
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
                'constraint' => 64,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'unique' => true,
            ],
            'icone' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'taxa' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => false,
                'default' => 0.00,
            ],
            'parcelas' => [
                'type' => 'INT',
                'constraint' => 2,
                'null' => false,
                'default' => 1,
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
        $this->forge->createTable('formas_pagamento');
    }

    public function down()
    {
        $this->forge->dropTable('formas_pagamento');
    }
}
