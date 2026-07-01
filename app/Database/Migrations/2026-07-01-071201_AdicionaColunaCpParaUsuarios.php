<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdicionaColunaCpParaUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuarios', [
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuarios', 'cpf');
    }
}
