<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use App\Models\UsuarioModel;
use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $usuarioModel = new UsuarioModel();

        $usuario1 = [
            'nome'          => 'João da Silva',
            'email'         => 'joao.silva@example.com',
            'telefone'      => '(11) 98765-4321',
            'cpf'           => '123.456.789-00',
            'is_admin'      => true,
            'ativo'         => true,
            'password_hash' => password_hash('123456', PASSWORD_DEFAULT),
            'criado_em'     => date('Y-m-d H:i:s'),
            'atualizado_em' => date('Y-m-d H:i:s'),
        ];

        $usuario2 = [
            'nome'          => 'Maria Oliveira',
            'email'         => 'maria.oliveira@example.com',
            'telefone'      => '(21) 91234-5678',
            'cpf'           => '987.654.321-00',
            'is_admin'      => false,
            'ativo'         => true,
            'password_hash' => password_hash('123456', PASSWORD_DEFAULT),
            'criado_em'     => date('Y-m-d H:i:s'),
            'atualizado_em' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('usuarios')->insert($usuario1);
        $this->db->table('usuarios')->insert($usuario2);

        echo "✅ Usuários criados com sucesso!\n";
        echo "   João: joao.silva@example.com / senha: 123456\n";
        echo "   Maria: maria.oliveira@example.com / senha: 123456\n";
    }
}
