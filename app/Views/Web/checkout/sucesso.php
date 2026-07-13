<?php echo $this->extend('Web/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo ?? 'Pedido confirmado'; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/bootstrap.min.css'); ?>">
<style>
    body {
        background: #fffaf6;
    }

    .confirm-shell {
        max-width: 900px;
        margin: 60px auto;
        padding: 24px;
    }

    .confirm-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, .08);
        padding: 32px;
        text-align: center;
    }

    .icon {
        font-size: 60px;
        color: #ff6b35;
    }

    .btn-home {
        background: #ff6b35;
        color: #fff;
        border-radius: 999px;
        padding: 10px 18px;
    }

    .btn-home:hover {
        background: #e45a24;
        color: #fff;
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="confirm-shell">
    <div class="confirm-card">
        <div class="icon"><i class="fa fa-check-circle"></i></div>
        <h2 class="mt-3">Pedido confirmado!</h2>
        <p class="text-muted">Seu pedido foi recebido com sucesso e já está sendo preparado para entrega.</p>
        <a href="<?php echo site_url('/'); ?>" class="btn btn-home mt-3">Voltar ao cardápio</a>
    </div>
</div>
<?php echo $this->endSection(); ?>