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

    // 🔥 ROTAS DE PRODUTOS
    $routes->get('produtos', 'Produtos::index');
    $routes->get('produtos/procurar', 'Produtos::procurar');
    $routes->get('produtos/criar', 'Produtos::criar');
    $routes->post('produtos/salvar', 'Produtos::salvar');
    $routes->get('produtos/show/(:num)', 'Produtos::show/$1');
    $routes->get('produtos/editar/(:num)', 'Produtos::editar/$1');
    $routes->post('produtos/atualizar/(:num)', 'Produtos::atualizar/$1');
    $routes->get('produtos/excluir/(:num)', 'Produtos::excluir/$1');
    $routes->get('produtos/restaurar/(:num)', 'Produtos::restaurar/$1');
    $routes->get('produtos/upload-imagem/(:num)', 'Produtos::uploadImagem/$1');
    $routes->post('produtos/salvar-imagem/(:num)', 'Produtos::salvarImagem/$1');

    // 🔥 ROTAS DE EXTRAS
    $routes->get('produtos/extras/(:num)', 'ProdutosExtras::index/$1');
    $routes->get('produtos/extras/criar/(:num)', 'ProdutosExtras::criar/$1');
    $routes->post('produtos/extras/salvar', 'ProdutosExtras::salvar');
    $routes->get('produtos/extras/excluir/(:num)', 'ProdutosExtras::excluir/$1');

    // 🔥 ROTAS DE ESPECIFICAÇÕES
    $routes->get('produtos/especificacoes/(:num)', 'ProdutosEspecificacoes::index/$1');
    $routes->get('produtos/especificacoes/criar/(:num)', 'ProdutosEspecificacoes::criar/$1');
    $routes->post('produtos/especificacoes/salvar', 'ProdutosEspecificacoes::salvar');
    $routes->get('produtos/especificacoes/excluir/(:num)', 'ProdutosEspecificacoes::excluir/$1');

    // 🔥 ROTAS DE MEDIDAS
    $routes->get('produtos/medidas/(:num)', 'ProdutosMedidas::index/$1');
    $routes->get('produtos/medidas/criar/(:num)', 'ProdutosMedidas::criar/$1');
    $routes->post('produtos/medidas/salvar', 'ProdutosMedidas::salvar');
    $routes->get('produtos/medidas/excluir/(:num)', 'ProdutosMedidas::excluir/$1');

    // 🔥 ROTAS DE FORMAS DE PAGAMENTO
    $routes->get('formas-pagamento', 'FormasPagamento::index');
    $routes->get('formas-pagamento/criar', 'FormasPagamento::criar');
    $routes->post('formas-pagamento/salvar', 'FormasPagamento::salvar');
    $routes->get('formas-pagamento/show/(:num)', 'FormasPagamento::show/$1');
    $routes->get('formas-pagamento/editar/(:num)', 'FormasPagamento::editar/$1');
    $routes->post('formas-pagamento/atualizar/(:num)', 'FormasPagamento::atualizar/$1');
    $routes->get('formas-pagamento/excluir/(:num)', 'FormasPagamento::excluir/$1');
    $routes->get('formas-pagamento/restaurar/(:num)', 'FormasPagamento::restaurar/$1');
});
