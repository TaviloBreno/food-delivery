<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Clientes extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();

        $clientes = $usuarioModel
            ->where('is_admin', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll(8);

        $data = [
            'titulo' => 'Dashboard de Clientes',
            'subtitulo' => 'Visão rápida dos clientes cadastrados no sistema.',
            'clientes' => $clientes,
            'totalClientes' => $usuarioModel->where('is_admin', 0)->countAllResults(),
            'clientesAtivos' => $usuarioModel->where('is_admin', 0)->where('ativo', 1)->countAllResults(),
            'clientesInativos' => $usuarioModel->where('is_admin', 0)->where('ativo', 0)->countAllResults(),
        ];

        return view('Admin/Clientes/index', $data);
    }
}
