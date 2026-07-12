<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo esc($titulo); ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
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
                    <div class="col-md-12">
                        <p class="card-text">
                            <span class="font-weight-bold">Bairro: </span>
                            <?php echo esc($bairro->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Slug: </span>
                            <?php echo esc($bairro->slug); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Cidade: </span>
                            <?php echo esc($bairro->cidade); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Estado: </span>
                            <?php echo esc($bairro->estado); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Taxa de entrega: </span>
                            <?php echo $bairro->getTaxaEntregaFormatada(); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Tempo médio: </span>
                            <?php echo $bairro->tempo_medio; ?> minutos
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Status: </span>
                            <?php echo $bairro->getStatusBadge(); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Criado em: </span>
                            <?php if ($bairro->criado_em): ?>
                                <?php echo esc($bairro->criado_em->humanize()); ?>
                            <?php else: ?>
                                <span class="text-muted">Não informado</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-actions">
                    <a href="<?php echo site_url('admin/bairros-atendidos'); ?>" class="btn btn-secondary btn-sm">
                        <i class="mdi mdi-arrow-left"></i> Voltar
                    </a>
                    <a href="<?php echo site_url('admin/bairros-atendidos/editar/' . $bairro->id); ?>" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-pencil"></i> Editar
                    </a>
                    <?php if ($bairro->deletado_em === null): ?>
                        <a href="<?php echo site_url('admin/bairros-atendidos/excluir/' . $bairro->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este bairro?')">
                            <i class="mdi mdi-delete"></i> Excluir
                        </a>
                    <?php else: ?>
                        <a href="<?php echo site_url('admin/bairros-atendidos/restaurar/' . $bairro->id); ?>" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-restore"></i> Restaurar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>