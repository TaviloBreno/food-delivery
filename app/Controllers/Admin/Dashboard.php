<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\CategoriaModel;

class Dashboard extends BaseController
{
    private UsuarioModel $usuarioModel;
    private CategoriaModel $categoriaModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function index()
    {
        $totalUsuarios = $this->usuarioModel->countAllResults();
        $totalUsuariosAtivos = $this->usuarioModel->where('ativo', 1)->countAllResults();
        $totalUsuariosInativos = $this->usuarioModel->where('ativo', 0)->countAllResults();
        $totalUsuariosDeletados = $this->usuarioModel->withDeleted()->where('deletado_em IS NOT NULL')->countAllResults();

        $totalCategorias = $this->categoriaModel->countAllResults();
        $totalCategoriasAtivas = $this->categoriaModel->where('ativo', 1)->countAllResults();

        $data = [
            'titulo' => 'Dashboard',
            'totalUsuarios' => $totalUsuarios,
            'totalUsuariosAtivos' => $totalUsuariosAtivos,
            'totalUsuariosInativos' => $totalUsuariosInativos,
            'totalUsuariosDeletados' => $totalUsuariosDeletados,
            'totalCategorias' => $totalCategorias,
            'totalCategoriasAtivas' => $totalCategoriasAtivas,
        ];

        return view('Admin/Dashboard/index', $data);
    }
}
