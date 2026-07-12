<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('login/novo', 'Login::novo');
$routes->post('login/autenticar', 'Login::autenticar');
$routes->get('login/logout', 'Login::logout');

// 🔥 ROTAS DO ADMIN
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {

    $routes->get('usuarios', 'Usuarios::index');
    $routes->get('usuarios/procurar', 'Usuarios::procurar');
    $routes->get('usuarios/criar', 'Usuarios::criar');
    $routes->post('usuarios/salvar', 'Usuarios::salvar');
    $routes->get('usuarios/show/(:num)', 'Usuarios::show/$1');
    $routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1');
    $routes->post('usuarios/atualizar/(:num)', 'Usuarios::atualizar/$1');
    $routes->get('usuarios/excluir/(:num)', 'Usuarios::excluir/$1');
    $routes->get('usuarios/restaurar/(:num)', 'Usuarios::restaurar/$1');
});
