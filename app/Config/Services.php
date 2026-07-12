<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Libraries\Autenticacao;
use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;
use App\Models\UsuarioModel;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. For more examples, see the core Services file at system/Config/Services.php.
 */
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
}
