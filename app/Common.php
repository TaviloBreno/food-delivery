<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (!function_exists('perfilUsuarioLogado')) {
    function perfilUsuarioLogado(): string
    {
        $session = session();
        $perfil = $session->get('perfil_slug');

        if (!empty($perfil)) {
            return strtolower((string) $perfil);
        }

        return ((int) $session->get('is_admin') === 1) ? 'admin' : 'cliente';
    }
}

if (!function_exists('podeAcessarModulo')) {
    function podeAcessarModulo(string $slug): bool
    {
        $perfil = perfilUsuarioLogado();

        $permissoesPorPerfil = [
            'admin' => [
                'dashboard.ver',
                'usuarios.ver',
                'clientes.ver',
                'funcionarios.ver',
                'categorias.ver',
                'produtos.ver',
                'pagamentos.ver',
                'entregadores.ver',
                'bairros.ver',
                'expediente.ver',
            ],
            'funcionario' => [
                'dashboard.ver',
                'categorias.ver',
                'produtos.ver',
                'pedidos.ver',
                'perfil.ver',
            ],
            'cliente' => [
                'produtos.ver',
                'categorias.ver',
                'pedidos.ver',
                'perfil.ver',
            ],
        ];

        return in_array($slug, $permissoesPorPerfil[$perfil] ?? [], true);
    }
}
