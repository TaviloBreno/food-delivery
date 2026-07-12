<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Libraries\Autenticacao;
use App\Services\UsuarioService;
use App\Services\DashboardService;
use App\Repositories\UsuarioRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\ProdutoRepository;
use App\Repositories\EntregadorRepository;
use App\Repositories\BairroRepository;
use App\Repositories\FormaPagamentoRepository;
use App\Models\UsuarioModel;
use App\Models\CategoriaModel;
use App\Models\ProdutoModel;
use App\Models\EntregadorModel;
use App\Models\BairroAtendidoModel;
use App\Models\FormaPagamentoModel;

class Services extends BaseService
{
    public static function autenticacao($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('autenticacao');
        }

        return new Autenticacao();
    }

    public static function usuarioService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('usuarioService');
        }

        $model = new UsuarioModel();
        $repository = new UsuarioRepository($model);
        return new UsuarioService($repository);
    }

    public static function dashboardService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('dashboardService');
        }

        $usuarioRepository = new UsuarioRepository(new UsuarioModel());
        $categoriaRepository = new CategoriaRepository(new CategoriaModel());
        $produtoRepository = new ProdutoRepository(new ProdutoModel());
        $entregadorRepository = new EntregadorRepository(new EntregadorModel());
        $bairroRepository = new BairroRepository(new BairroAtendidoModel());
        $formaPagamentoRepository = new FormaPagamentoRepository(new FormaPagamentoModel());

        return new DashboardService(
            $usuarioRepository,
            $categoriaRepository,
            $produtoRepository,
            $entregadorRepository,
            $bairroRepository,
            $formaPagamentoRepository,
        );
    }

    public static function categoriaService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('categoriaService');
        }

        $model = new \App\Models\CategoriaModel();
        $repository = new \App\Repositories\CategoriaRepository($model);
        return new \App\Services\CategoriaService($repository);
    }
}
