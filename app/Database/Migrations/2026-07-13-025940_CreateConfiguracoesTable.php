<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateConfiguracoesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cidade' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'Sua Cidade',
            ],
            'endereco' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'default' => 'Seu Endereço',
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => '(00) 0000-0000',
            ],
            'horario_funcionamento' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => '11:00 - 23:00',
            ],
            'sobre' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sobre_extra' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sobre_footer' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'endereco_completo' => [
                'type' => 'VARCHAR',
                'constraint' => 300,
                'default' => 'Av. Paulista, 1000 - São Paulo - SP',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'contato@fooddelivery.com',
            ],
            'google_maps_api_key' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'default' => 'AIzaSyBcg5Y2D1fpGI12T8wcbtPIsyGdw-_NV1Y',
            ],
            'chave' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'valor' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('chave');
        $this->forge->createTable('configuracoes');
    }

    public function down()
    {
        $this->forge->dropTable('configuracoes');
    }
}
