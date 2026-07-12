<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <!-- 🔥 CABEÇALHO -->
                <?php echo view('Admin/Usuarios/partials/_cabecalho', [
                    'titulo' => $titulo,
                    'subtitulo' => $subtitulo ?? 'Listagem completa dos usuários cadastrados',
                    'botao_texto' => 'Novo usuário',
                    'botao_url' => site_url('admin/usuarios/criar'),
                    'botao_icone' => 'mdi-plus'
                ]); ?>

                <!-- 🔥 FILTROS -->
                <?php echo view('Admin/Usuarios/partials/_filtros', [
                    'placeholder' => 'Pesquise por um usuário',
                    'input_id' => 'query'
                ]); ?>

                <!-- 🔥 TOTAL DE REGISTROS -->
                <?php echo view('Admin/Usuarios/partials/_total_registros', [
                    'total' => $total ?? 0,
                    'label' => 'Total de usuários'
                ]); ?>

                <!-- 🔥 TABELA -->
                <?php echo view('Admin/Usuarios/partials/_tabela', [
                    'usuarios' => $usuarios,
                    'classe' => 'table-usuarios'
                ]); ?>

                <!-- 🔥 PAGINAÇÃO -->
                <?php echo view('Admin/Usuarios/partials/_paginacao', [
                    'pager' => $pager,
                    'total' => $total ?? 0,
                    'perPage' => $perPage ?? 10,
                    'base_url' => 'admin/usuarios'
                ]); ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    window.autocompleteUrl = "<?php echo site_url('admin/usuarios/procurar'); ?>";
    window.showUrl = "<?php echo site_url('admin/usuarios/show'); ?>";
</script>
<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>
<script src="<?php echo site_url('admin/js/usuarios/index.js'); ?>"></script>
<script src="<?php echo site_url('admin/js/shared/paginacao.js'); ?>"></script>
<?php echo $this->endSection(); ?>