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
                            <span class="font-weight-bold">Nome: </span>
                            <?php echo esc($forma->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Slug: </span>
                            <?php echo esc($forma->slug); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Ícone: </span>
                            <i class="mdi <?php echo $forma->icone ?? 'mdi-credit-card'; ?>"></i>
                            <?php echo esc($forma->icone ?? 'Nenhum'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Descrição: </span>
                            <br>
                            <?php echo esc($forma->descricao ?? 'Nenhuma descrição cadastrada.'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Taxa: </span>
                            <?php echo number_format($forma->taxa, 2, ',', '.') . '%'; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Parcelas: </span>
                            <?php echo $forma->parcelas; ?>x
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Status: </span>
                            <?php if ($forma->deletado_em !== null): ?>
                                <span class="badge badge-danger">Excluído</span>
                            <?php elseif ($forma->ativo == 1): ?>
                                <span class="badge badge-success">Ativo</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Inativo</span>
                            <?php endif; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Criado em: </span>
                            <?php if ($forma->criado_em): ?>
                                <?php echo esc($forma->criado_em->humanize()); ?>
                            <?php else: ?>
                                <span class="text-muted">Não informado</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-actions">
                    <a href="<?php echo site_url('admin/formas-pagamento'); ?>" class="btn btn-secondary btn-sm">
                        <i class="mdi mdi-arrow-left"></i> Voltar
                    </a>
                    <a href="<?php echo site_url('admin/formas-pagamento/editar/' . $forma->id); ?>" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-pencil"></i> Editar
                    </a>
                    <?php if ($forma->deletado_em === null): ?>
                        <a href="<?php echo site_url('admin/formas-pagamento/excluir/' . $forma->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta forma de pagamento?')">
                            <i class="mdi mdi-delete"></i> Excluir
                        </a>
                    <?php else: ?>
                        <a href="<?php echo site_url('admin/formas-pagamento/restaurar/' . $forma->id); ?>" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-restore"></i> Restaurar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>