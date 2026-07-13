<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo esc($titulo); ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/produtos.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body bg-primary pb-0 pt-4">
                <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Imagem atual</h5>
                        <div class="text-center">
                            <img src="<?php echo $produto->getImagemUrl(); ?>" alt="<?php echo $produto->nome; ?>" class="produto-imagem-atual">
                            <p class="mt-2 text-muted"><?php echo $produto->imagem ? $produto->imagem : 'Nenhuma imagem cadastrada'; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Nova imagem</h5>
                        <form action="<?php echo site_url('admin/produtos/salvar-imagem/' . $produto->id); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="upload-area" id="uploadArea">
                                <i class="mdi mdi-cloud-upload"></i>
                                <p><strong>Clique para selecionar uma imagem</strong> ou arraste até aqui</p>
                                <input type="file" id="imagem" name="imagem" accept="image/*" style="display: none;">
                                <div id="preview-container" class="mt-3" style="display: none;">
                                    <img id="preview" class="preview-imagem" alt="Pré-visualização">
                                </div>
                            </div>
                            <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Máximo: 2MB</small>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-upload"></i> Enviar imagem
                                </button>
                                <a href="<?php echo site_url('admin/produtos/show/' . $produto->id); ?>" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i> Voltar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script src="<?php echo site_url('admin/js/produtos.js'); ?>"></script>
<?php echo $this->endSection(); ?>