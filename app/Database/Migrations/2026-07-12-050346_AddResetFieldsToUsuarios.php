<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResetFieldsToUsuarios extends Migration
{
    public function up()
    {
        if (!$this->db->tableExists('usuarios')) {
            return;
        }

        $fields = $this->db->getFieldData('usuarios');
        $existingFields = array_column($fields, 'name');

        // 🔥 SÓ ADICIONA O CAMPO SE ELE NÃO EXISTIR
        if (!in_array('reset_hash', $existingFields)) {
            $this->forge->addColumn('usuarios', [
                'reset_hash' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 64,
                    'null'       => true,
                    'default'    => null,
                    'after'      => 'password_hash',
                ],
            ]);
        }

        if (!in_array('reset_expira_em', $existingFields)) {
            $this->forge->addColumn('usuarios', [
                'reset_expira_em' => [
                    'type'       => 'DATETIME',
                    'null'       => true,
                    'default'    => null,
                    'after'      => 'reset_hash',
                ],
            ]);
        }
    }

    public function down()
    {
        $fields = $this->db->getFieldData('usuarios');
        $existingFields = array_column($fields, 'name');

        if (in_array('reset_hash', $existingFields)) {
            $this->forge->dropColumn('usuarios', 'reset_hash');
        }

        if (in_array('reset_expira_em', $existingFields)) {
            $this->forge->dropColumn('usuarios', 'reset_expira_em');
        }
    }
}
