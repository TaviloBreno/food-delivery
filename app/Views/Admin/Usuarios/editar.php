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

                <?php if (session()->has('errors_model')): ?>

                    <ul>
                        <?php foreach (session('errors_model') as $error): ?>

                            <li class="text-danger"><?php echo $error; ?></li>

                        <?php endforeach; ?>
                    </ul>

                <?php endif; ?>

                <?php echo view('Admin/Usuarios/form', ['usuario' => $usuario]); ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script src="<?php echo site_url('admin/vendors/jquery-mask/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo site_url('admin/js/usuarios-form.js'); ?>"></script>
<script src="<?php echo site_url('admin/js/senha-forca.js'); ?>"></script>
<?php echo $this->endSection(); ?>