<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Funcionarios extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();

        $funcionarios = $usuarioModel
            ->where('is_admin', 1)
            ->orderBy('criado_em', 'DESC')
            ->findAll(8);

        $data = [
            'titulo' => 'Dashboard de Funcionários',
            'subtitulo' => 'Gerencie os colaboradores com acesso ao painel administrativo.',
            'funcionarios' => $funcionarios,
            'totalFuncionarios' => $usuarioModel->where('is_admin', 1)->countAllResults(),
            'funcionariosAtivos' => $usuarioModel->where('is_admin', 1)->where('ativo', 1)->countAllResults(),
            'funcionariosInativos' => $usuarioModel->where('is_admin', 1)->where('ativo', 0)->countAllResults(),
        ];

        return view('Admin/Funcionarios/index', $data);
    }
}
