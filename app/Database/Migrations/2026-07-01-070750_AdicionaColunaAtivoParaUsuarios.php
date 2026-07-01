<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdicionaColunaAtivoParaUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuarios', [
            'ativo' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuarios', 'ativo');
    }
}
