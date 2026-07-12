<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo esc($titulo); ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body bg-primary pb-0 pt-4">
                <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('admin/produtos/extras/salvar'); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="produto_id" value="<?php echo $produto->id; ?>">

                    <div class="form-group">
                        <label for="nome">Nome do extra <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control"
                            id="nome"
                            name="nome"
                            placeholder="Ex: Bacon, Queijo Extra, Ovo"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="preco">Preço <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control"
                            id="preco"
                            name="preco"
                            placeholder="0,00"
                            required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i> Salvar extra
                        </button>
                        <a href="<?php echo site_url('admin/produtos/extras/' . $produto->id); ?>" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    $('#preco').mask('000.000.000.000.000,00', {
        reverse: true
    });
</script>
<?php echo $this->endSection(); ?>