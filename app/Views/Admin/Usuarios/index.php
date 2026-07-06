<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0"><?php echo $titulo; ?></h4>
                    <a href="<?php echo site_url('admin/usuarios/criar'); ?>" class="btn btn-success btn-sm">
                        <i class="mdi mdi-plus"></i> Novo usuário
                    </a>
                </div>

                <div class="ui-widget">
                    <input id="query" name="query" placeholder="Pesquise por um usuário" class="form-control bg-light mb-5">
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-usuarios">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Ativo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo $usuario->id; ?></td>
                                <td>
                                    <a href="<?php echo site_url("admin/usuarios/show/$usuario->id"); ?>">
                                        <?php echo $usuario->nome; ?>
                                    </a>
                                </td>
                                <td><?php echo $usuario->cpf; ?></td>
                                <td><?php echo $usuario->telefone; ?></td>
                                <td><?php echo($usuario->ativo ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>'); ?></td>
                            </tr>
                            <?php endforeach; ?>
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
    // 🔥 Passa as URLs para o JavaScript
    window.autocompleteUrl = "<?php echo site_url('admin/usuarios/procurar'); ?>";
    window.showUrl = "<?php echo site_url('admin/usuarios/show'); ?>";
</script>
<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>
<script src="<?php echo site_url('admin/js/usuarios-index.js'); ?>"></script>
<?php echo $this->endSection(); ?>