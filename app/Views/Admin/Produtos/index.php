<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('admin/css/produtos.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <!-- 🔥 CABEÇALHO -->
                <?php echo view('Admin/Produtos/partials/_cabecalho', [
                    'titulo' => $titulo,
                    'botao_texto' => 'Novo produto',
                    'botao_url' => site_url('admin/produtos/criar'),
                ]); ?>

                <!-- 🔥 FILTROS -->
                <?php echo view('Admin/Produtos/partials/_filtros', [
                    'placeholder' => 'Pesquise por um produto',
                ]); ?>

                <!-- 🔥 TOTAL -->
                <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                    <span class="text-muted" style="font-size: 13px;">
                        Total de produtos: <strong><?php echo $total ?? 0; ?></strong>
                    </span>
                </div>

                <!-- 🔥 TABELA -->
                <?php echo view('Admin/Produtos/partials/_tabela_produtos', [
                    'produtos' => $produtos,
                ]); ?>

                <!-- 🔥 PAGINAÇÃO -->
                <?php echo view('Admin/Produtos/partials/_paginacao', [
                    'pager' => $pager,
                    'total' => $total ?? 0,
                    'perPage' => $perPage ?? 10,
                    'base_url' => 'admin/produtos',
                ]); ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    window.autocompleteUrl = "<?php echo site_url('admin/produtos/procurar'); ?>";
    window.showUrl = "<?php echo site_url('admin/produtos/show'); ?>";
</script>
<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>
<script src="<?php echo site_url('admin/js/produtos/index.js'); ?>"></script>
<script src="<?php echo site_url('admin/js/shared/paginacao.js'); ?>"></script>
<?php echo $this->endSection(); ?>