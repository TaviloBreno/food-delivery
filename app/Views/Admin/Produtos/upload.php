<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo esc($titulo); ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
<style>
    .upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 40px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: #4d83ff;
        background: #f8f9fa;
    }

    .upload-area .mdi {
        font-size: 4rem;
        color: #6c757d;
    }

    .upload-area p {
        color: #6c757d;
        margin-top: 10px;
    }

    .preview-imagem {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .produto-imagem-atual {
        max-width: 150px;
        max-height: 150px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>
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
<script>
    const uploadArea = document.getElementById('uploadArea');
    const inputFile = document.getElementById('imagem');
    const previewContainer = document.getElementById('preview-container');
    const preview = document.getElementById('preview');

    uploadArea.addEventListener('click', function() {
        inputFile.click();
    });

    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#4d83ff';
        this.style.background = '#f8f9fa';
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = '#dee2e6';
        this.style.background = 'transparent';
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#dee2e6';
        this.style.background = 'transparent';

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            inputFile.files = files;
            previewFile(files[0]);
        }
    });

    inputFile.addEventListener('change', function() {
        if (this.files.length > 0) {
            previewFile(this.files[0]);
        }
    });

    function previewFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
            uploadArea.querySelector('p').textContent = 'Arquivo selecionado: ' + file.name;
        };
        reader.readAsDataURL(file);
    }
</script>
<?php echo $this->endSection(); ?>