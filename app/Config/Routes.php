<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('login/novo', 'Login::novo');
$routes->post('login/autenticar', 'Login::autenticar');
$routes->get('login/logout', 'Login::logout');

// 🔥 ROTAS DE RESET DE SENHA
$routes->get('login/esqueci', 'Login::esqueci');
$routes->post('login/solicitar-reset', 'Login::solicitarReset');
$routes->get('login/redefinir/(:any)', 'Login::redefinir/$1');
$routes->post('login/salvar-nova-senha', 'Login::salvarNovaSenha');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function ($routes) {
    // 🔥 DASHBOARD
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('/', 'Dashboard::index');

    // 🔥 ROTAS DE USUÁRIOS
    $routes->get('usuarios', 'Usuarios::index');
    $routes->get('usuarios/procurar', 'Usuarios::procurar');
    $routes->get('usuarios/criar', 'Usuarios::criar');
    $routes->post('usuarios/salvar', 'Usuarios::salvar');
    $routes->get('usuarios/show/(:num)', 'Usuarios::show/$1');
    $routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1');
    $routes->post('usuarios/atualizar/(:num)', 'Usuarios::atualizar/$1');
    $routes->get('usuarios/excluir/(:num)', 'Usuarios::excluir/$1');
    $routes->get('usuarios/restaurar/(:num)', 'Usuarios::restaurar/$1');

    // 🔥 ROTAS DE CATEGORIAS
    $routes->get('categorias', 'Categorias::index');
    $routes->get('categorias/procurar', 'Categorias::procurar');
    $routes->get('categorias/criar', 'Categorias::criar');
    $routes->post('categorias/salvar', 'Categorias::salvar');
    $routes->get('categorias/show/(:num)', 'Categorias::show/$1');
    $routes->get('categorias/editar/(:num)', 'Categorias::editar/$1');
    $routes->post('categorias/atualizar/(:num)', 'Categorias::atualizar/$1');
    $routes->get('categorias/excluir/(:num)', 'Categorias::excluir/$1');
    $routes->get('categorias/restaurar/(:num)', 'Categorias::restaurar/$1');
});
