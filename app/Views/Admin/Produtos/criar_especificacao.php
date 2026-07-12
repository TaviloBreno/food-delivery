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
                <form action="<?php echo site_url('admin/produtos/especificacoes/salvar'); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="produto_id" value="<?php echo $produto->id; ?>">

                    <div class="form-group">
                        <label for="nome">Nome da especificação <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control"
                            id="nome"
                            name="nome"
                            placeholder="Ex: Tamanho, Cor, Peso"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="valor">Valor <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control"
                            id="valor"
                            name="valor"
                            placeholder="Ex: Grande, Vermelho, 500g"
                            required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i> Salvar especificação
                        </button>
                        <a href="<?php echo site_url('admin/produtos/especificacoes/' . $produto->id); ?>" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>