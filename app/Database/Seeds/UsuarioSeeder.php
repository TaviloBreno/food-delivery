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

        $usuario = [
            'nome' => 'João da Silva',
            'email' => 'joao.silva@example.com',
            'telefone' => '(11) 98765-4321',
        ];

        $usuarioModel->protect(false)->insert($usuario);

        $usuario = [
            'nome' => 'Maria Oliveira',
            'email' => 'maria.oliveira@example.com',
            'telefone' => '(21) 91234-5678',
        ];

        $usuarioModel->protect(false)->insert($usuario);

        dd($usuarioModel->errors());
    }
}
