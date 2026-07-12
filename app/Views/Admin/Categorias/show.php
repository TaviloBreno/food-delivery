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
                    <div class="col-md-6">
                        <p class="card-text">
                            <span class="font-weight-bold">Nome: </span>
                            <?php echo esc($categoria->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Slug: </span>
                            <?php echo esc($categoria->slug); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Ícone: </span>
                            <i class="mdi <?php echo $categoria->icone ?? 'mdi-folder'; ?>"></i>
                            <?php echo esc($categoria->icone ?? 'Nenhum'); ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="card-text">
                            <span class="font-weight-bold">Status: </span>
                            <?php echo ($categoria->ativo ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Situação: </span>
                            <?php if ($categoria->deletado_em !== null): ?>
                                <span class="badge badge-danger">Excluído</span>
                            <?php else: ?>
                                <span class="badge badge-primary">Ativo</span>
                            <?php endif; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Criado em: </span>
                            <?php if ($categoria->criado_em): ?>
                                <?php echo esc($categoria->criado_em->humanize()); ?>
                            <?php else: ?>
                                <span class="text-muted">Não informado</span>
                            <?php endif; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Última atualização: </span>
                            <?php if ($categoria->atualizado_em): ?>
                                <?php echo esc($categoria->atualizado_em->humanize()); ?>
                            <?php else: ?>
                                <span class="text-muted">Não informado</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="card-text">
                            <span class="font-weight-bold">Descrição: </span>
                            <br>
                            <?php echo esc($categoria->descricao ?? 'Nenhuma descrição cadastrada.'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-actions">
                    <a href="<?php echo site_url('admin/categorias'); ?>" class="btn btn-secondary btn-sm">
                        <i class="mdi mdi-arrow-left"></i> Voltar
                    </a>
                    <a href="<?php echo site_url('admin/categorias/editar/' . $categoria->id); ?>" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-pencil"></i> Editar
                    </a>
                    <?php if ($categoria->deletado_em === null): ?>
                        <a href="<?php echo site_url('admin/categorias/excluir/' . $categoria->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                            <i class="mdi mdi-delete"></i> Excluir
                        </a>
                    <?php else: ?>
                        <a href="<?php echo site_url('admin/categorias/restaurar/' . $categoria->id); ?>" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-restore"></i> Restaurar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<?php echo $this->endSection(); ?>