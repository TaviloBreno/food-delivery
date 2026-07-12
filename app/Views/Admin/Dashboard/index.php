<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/dashboard.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<!-- 🔥 CABEÇALHO -->
<div class="row">
    <div class="col-12">
        <div class="welcome-text">
            <h1 class="dashboard-title">👋 Olá, <span class="user-name"><?php echo session('usuario_nome') ?? 'Usuário'; ?></span>!</h1>
            <p class="dashboard-subtitle">Bem-vindo ao painel administrativo do Food Delivery. Aqui você gerencia todo o sistema.</p>
        </div>
    </div>
</div>

<!-- 🔥 CARDS PRINCIPAIS -->
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="mdi mdi-account-multiple"></i></div>
            <div class="stat-number"><?php echo $totalUsuarios; ?></div>
            <div class="stat-label">Total de Usuários</div>
            <div class="stat-change">
                <i class="mdi mdi-account-check"></i> <?php echo $totalUsuariosAtivos; ?> ativos
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="mdi mdi-food"></i></div>
            <div class="stat-number"><?php echo $totalProdutos; ?></div>
            <div class="stat-label">Total de Produtos</div>
            <div class="stat-change">
                <i class="mdi mdi-star"></i> <?php echo $totalProdutosDestaque; ?> em destaque
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-warning">
            <div class="stat-icon"><i class="mdi mdi-motorbike"></i></div>
            <div class="stat-number"><?php echo $totalEntregadores; ?></div>
            <div class="stat-label">Total de Entregadores</div>
            <div class="stat-change">
                <i class="mdi mdi-check-circle"></i> <?php echo $totalEntregadoresDisponiveis; ?> disponíveis
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="mdi mdi-map-marker"></i></div>
            <div class="stat-number"><?php echo $totalBairros; ?></div>
            <div class="stat-label">Bairros Atendidos</div>
            <div class="stat-change">
                <i class="mdi mdi-check-circle"></i> <?php echo $totalBairrosAtivos; ?> ativos
            </div>
        </div>
    </div>
</div>

<!-- 🔥 CARDS SECUNDÁRIOS -->
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-danger">
            <div class="stat-icon"><i class="mdi mdi-account-off"></i></div>
            <div class="stat-number"><?php echo $totalUsuariosInativos; ?></div>
            <div class="stat-label">Usuários Inativos</div>
            <div class="stat-change">
                <i class="mdi mdi-delete"></i> <?php echo $totalUsuariosDeletados; ?> excluídos
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-pink">
            <div class="stat-icon"><i class="mdi mdi-folder-outline"></i></div>
            <div class="stat-number"><?php echo $totalCategorias; ?></div>
            <div class="stat-label">Total de Categorias</div>
            <div class="stat-change">
                <i class="mdi mdi-check-circle"></i> <?php echo $totalCategoriasAtivas; ?> ativas
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-orange">
            <div class="stat-icon"><i class="mdi mdi-credit-card"></i></div>
            <div class="stat-number"><?php echo $totalFormasPagamento; ?></div>
            <div class="stat-label">Formas de Pagamento</div>
            <div class="stat-change">
                <i class="mdi mdi-check-circle"></i> <?php echo $totalFormasPagamentoAtivas; ?> ativas
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-purple">
            <div class="stat-icon"><i class="mdi mdi-package"></i></div>
            <div class="stat-number"><?php echo $totalProdutosInativos; ?></div>
            <div class="stat-label">Produtos Inativos</div>
            <div class="stat-change">
                <i class="mdi mdi-food-off"></i> Aguardando ativação
            </div>
        </div>
    </div>
</div>

<!-- 🔥 ÚLTIMOS REGISTROS -->
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="section-title"><i class="mdi mdi-account-multiple"></i> Últimos Usuários</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-ultimos">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($ultimosUsuarios)): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-2">Nenhum usuário cadastrado</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($ultimosUsuarios as $usuario): ?>
                                    <tr>
                                        <td><?php echo esc($usuario->nome); ?></td>
                                        <td><?php echo esc($usuario->email); ?></td>
                                        <td>
                                            <?php if ($usuario->ativo == 1): ?>
                                                <span class="badge badge-success">Ativo</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Inativo</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="section-title"><i class="mdi mdi-food"></i> Últimos Produtos</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-ultimos">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($ultimosProdutos)): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-2">Nenhum produto cadastrado</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($ultimosProdutos as $produto): ?>
                                    <tr>
                                        <td><?php echo esc($produto->nome); ?></td>
                                        <td><?php echo esc($produto->categoria_nome); ?></td>
                                        <td>R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 🔥 INFORMAÇÕES DO SISTEMA -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="section-title"><i class="mdi mdi-information"></i> Informações do Sistema</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width: 200px;"><strong>Versão do PHP</strong></td>
                                <td><?php echo phpversion(); ?></td>
                            </tr>
                            <tr>
                                <td><strong>CodeIgniter</strong></td>
                                <td>4.7.3</td>
                            </tr>
                            <tr>
                                <td><strong>Ambiente</strong></td>
                                <td><?php echo ENVIRONMENT; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Data/Hora</strong></td>
                                <td><?php echo date('d/m/Y H:i:s'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Usuário Logado</strong></td>
                                <td><?php echo session('usuario_nome') ?? 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Total de Registros</strong></td>
                                <td>
                                    <?php
                                    $totalRegistros = $totalUsuarios + $totalProdutos + $totalCategorias + $totalEntregadores + $totalBairros + $totalFormasPagamento;
                                    echo $totalRegistros;
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script src="<?php echo site_url('admin/js/dashboard.js'); ?>"></script>
<?php echo $this->endSection(); ?>