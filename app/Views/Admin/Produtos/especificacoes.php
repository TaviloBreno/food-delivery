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
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="<?php echo site_url('admin/produtos/show/' . $produto->id); ?>" class="btn btn-secondary btn-sm">
                        <i class="mdi mdi-arrow-left"></i> Voltar ao produto
                    </a>
                    <a href="<?php echo site_url('admin/produtos/especificacoes/criar/' . $produto->id); ?>" class="btn btn-success btn-sm">
                        <i class="mdi mdi-plus"></i> Nova especificação
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($especificacoes)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">
                                        <i class="mdi mdi-list-box-outline" style="font-size: 1.5rem; display: block; margin-bottom: 5px;"></i>
                                        Nenhuma especificação cadastrada
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($especificacoes as $especificacao): ?>
                                    <tr>
                                        <td><?php echo $especificacao->id; ?></td>
                                        <td><?php echo esc($especificacao->nome); ?></td>
                                        <td><?php echo esc($especificacao->valor); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url("admin/produtos/especificacoes/excluir/{$especificacao->id}"); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Tem certeza que deseja excluir esta especificação?')">
                                                <i class="mdi mdi-delete"></i> Excluir
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>