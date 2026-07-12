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
                    <a href="<?php echo site_url('admin/produtos/extras/criar/' . $produto->id); ?>" class="btn btn-success btn-sm">
                        <i class="mdi mdi-plus"></i> Novo extra
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($extras)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">
                                        <i class="mdi mdi-food-off" style="font-size: 1.5rem; display: block; margin-bottom: 5px;"></i>
                                        Nenhum extra cadastrado
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($extras as $extra): ?>
                                    <tr>
                                        <td><?php echo $extra->id; ?></td>
                                        <td><?php echo esc($extra->nome); ?></td>
                                        <td>R$ <?php echo number_format($extra->preco, 2, ',', '.'); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url("admin/produtos/extras/excluir/{$extra->id}"); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Tem certeza que deseja excluir este extra?')">
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