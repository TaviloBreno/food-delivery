<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo ?? 'Funcionários'; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/dashboard.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-12">
        <div class="welcome-text mb-4">
            <h1 class="dashboard-title">Funcionários</h1>
            <p class="dashboard-subtitle"><?php echo esc($subtitulo ?? 'Resumo dos colaboradores administrativos.'); ?></p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="mdi mdi-account-star"></i></div>
            <div class="stat-number"><?php echo $totalFuncionarios ?? 0; ?></div>
            <div class="stat-label">Total de funcionários</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="mdi mdi-account-check"></i></div>
            <div class="stat-number"><?php echo $funcionariosAtivos ?? 0; ?></div>
            <div class="stat-label">Ativos</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-danger">
            <div class="stat-icon"><i class="mdi mdi-account-off"></i></div>
            <div class="stat-number"><?php echo $funcionariosInativos ?? 0; ?></div>
            <div class="stat-label">Inativos</div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h4 class="section-title"><i class="mdi mdi-account-tie"></i> Últimos funcionários</h4>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($funcionarios)): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Nenhum funcionário encontrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($funcionarios as $funcionario): ?>
                            <tr>
                                <td><?php echo esc($funcionario->nome); ?></td>
                                <td><?php echo esc($funcionario->email); ?></td>
                                <td>
                                    <?php if (!empty($funcionario->ativo)): ?>
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
<?php echo $this->endSection(); ?>