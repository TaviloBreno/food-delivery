<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<style>
    .stat-card {
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        color: #fff;
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card .stat-icon {
        font-size: 2.5rem;
        opacity: 0.8;
    }

    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
    }

    .stat-card .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .stat-primary {
        background: linear-gradient(135deg, #4d83ff, #6c5ce7);
    }

    .stat-success {
        background: linear-gradient(135deg, #00b894, #00cec9);
    }

    .stat-danger {
        background: linear-gradient(135deg, #fd79a8, #e17055);
    }

    .stat-warning {
        background: linear-gradient(135deg, #fdcb6e, #f39c12);
    }

    .stat-info {
        background: linear-gradient(135deg, #74b9ff, #0984e3);
    }

    .stat-purple {
        background: linear-gradient(135deg, #a29bfe, #6c5ce7);
    }

    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 10px;
    }

    .dashboard-subtitle {
        color: #6c757d;
        margin-bottom: 30px;
    }

    .welcome-text {
        font-size: 1.2rem;
        color: #2c2c2c;
    }

    .welcome-text .user-name {
        color: #4d83ff;
        font-weight: 600;
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
    <div class="col-12">
        <div class="welcome-text">
            <h1 class="dashboard-title">👋 Olá, <span class="user-name"><?php echo session('usuario_nome') ?? 'Usuário'; ?></span>!</h1>
            <p class="dashboard-subtitle">Bem-vindo ao painel administrativo do Food Delivery. Aqui você gerencia todo o sistema.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number"><?php echo $totalUsuarios; ?></div>
                    <div class="stat-label">Total de Usuários</div>
                </div>
                <div class="stat-icon">
                    <i class="mdi mdi-account-multiple"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number"><?php echo $totalUsuariosAtivos; ?></div>
                    <div class="stat-label">Usuários Ativos</div>
                </div>
                <div class="stat-icon">
                    <i class="mdi mdi-account-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number"><?php echo $totalUsuariosInativos; ?></div>
                    <div class="stat-label">Usuários Inativos</div>
                </div>
                <div class="stat-icon">
                    <i class="mdi mdi-account-off"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number"><?php echo $totalUsuariosDeletados; ?></div>
                    <div class="stat-label">Usuários Excluídos</div>
                </div>
                <div class="stat-icon">
                    <i class="mdi mdi-delete"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number"><?php echo $totalCategorias; ?></div>
                    <div class="stat-label">Total de Categorias</div>
                </div>
                <div class="stat-icon">
                    <i class="mdi mdi-folder-outline"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="stat-card stat-purple">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number"><?php echo $totalCategoriasAtivas; ?></div>
                    <div class="stat-label">Categorias Ativas</div>
                </div>
                <div class="stat-icon">
                    <i class="mdi mdi-folder-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">📊 Informações do Sistema</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Versão do PHP</strong></td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    // Anima os números dos cards
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.stat-number').forEach(function(el) {
            const text = el.textContent;
            el.textContent = '0';
            let current = 0;
            const target = parseInt(text);
            const step = Math.max(1, Math.floor(target / 30));

            const interval = setInterval(function() {
                current += step;
                if (current >= target) {
                    current = target;
                    clearInterval(interval);
                }
                el.textContent = current;
            }, 50);
        });
    });
</script>
<?php echo $this->endSection(); ?>