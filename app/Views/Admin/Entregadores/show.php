<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo esc($titulo); ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
<style>
    .entregador-foto {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body bg-primary pb-0 pt-4">
                <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="<?php echo $entregador->getFotoUrl(); ?>" alt="<?php echo $entregador->nome; ?>" class="entregador-foto">
                        <div class="mt-3">
                            <a href="<?php echo site_url('admin/entregadores/upload-foto/' . $entregador->id); ?>" class="btn btn-warning btn-sm">
                                <i class="mdi mdi-camera"></i> Alterar foto
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p class="card-text">
                            <span class="font-weight-bold">Nome: </span>
                            <?php echo esc($entregador->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">E-mail: </span>
                            <?php echo esc($entregador->email); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">CPF: </span>
                            <?php echo esc($entregador->cpf); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Telefone: </span>
                            <?php echo esc($entregador->telefone); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">CNH: </span>
                            <?php echo esc($entregador->cnh ?? 'Não informada'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Veículo: </span>
                            <?php echo esc($entregador->modelo_veiculo ?? 'Não informado'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Placa: </span>
                            <?php echo esc($entregador->placa_veiculo ?? 'Não informada'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Cor do veículo: </span>
                            <?php echo esc($entregador->cor_veiculo ?? 'Não informada'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Status: </span>
                            <?php echo $entregador->getStatusBadge(); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Criado em: </span>
                            <?php if ($entregador->criado_em): ?>
                                <?php echo esc($entregador->criado_em->humanize()); ?>
                            <?php else: ?>
                                <span class="text-muted">Não informado</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-actions">
                    <a href="<?php echo site_url('admin/entregadores'); ?>" class="btn btn-secondary btn-sm">
                        <i class="mdi mdi-arrow-left"></i> Voltar
                    </a>
                    <a href="<?php echo site_url('admin/entregadores/editar/' . $entregador->id); ?>" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-pencil"></i> Editar
                    </a>
                    <?php if ($entregador->deletado_em === null): ?>
                        <a href="<?php echo site_url('admin/entregadores/excluir/' . $entregador->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este entregador?')">
                            <i class="mdi mdi-delete"></i> Excluir
                        </a>
                    <?php else: ?>
                        <a href="<?php echo site_url('admin/entregadores/restaurar/' . $entregador->id); ?>" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-restore"></i> Restaurar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>