<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo esc($titulo); ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
<style>
    .produto-imagem {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-purple {
        background: #6f42c1;
        border-color: #6f42c1;
        color: #fff;
    }

    .btn-purple:hover {
        background: #5a32a3;
        border-color: #5a32a3;
        color: #fff;
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
                        <img src="<?php echo $produto->getImagemUrl(); ?>" alt="<?php echo $produto->nome; ?>" class="produto-imagem">
                        <div class="mt-3">
                            <a href="<?php echo site_url('admin/produtos/upload-imagem/' . $produto->id); ?>" class="btn btn-warning btn-sm">
                                <i class="mdi mdi-camera"></i> Alterar imagem
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p class="card-text">
                            <span class="font-weight-bold">Categoria: </span>
                            <?php echo $categoria_nome ?? 'N/A'; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Nome: </span>
                            <?php echo esc($produto->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Slug: </span>
                            <?php echo esc($produto->slug); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Preço: </span>
                            R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?>
                        </p>
                        <?php if ($produto->preco_promocional): ?>
                            <p class="card-text">
                                <span class="font-weight-bold">Preço promocional: </span>
                                <span class="text-danger font-weight-bold">R$ <?php echo number_format($produto->preco_promocional, 2, ',', '.'); ?></span>
                            </p>
                        <?php endif; ?>
                        <p class="card-text">
                            <span class="font-weight-bold">Descrição: </span>
                            <br>
                            <?php echo esc($produto->descricao ?? 'Nenhuma descrição cadastrada.'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Status: </span>
                            <?php if ($produto->deletado_em !== null): ?>
                                <span class="badge badge-danger">Excluído</span>
                            <?php elseif ($produto->ativo == 1): ?>
                                <span class="badge badge-success">Ativo</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Inativo</span>
                            <?php endif; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Destaque: </span>
                            <?php echo ($produto->destaque == 1 ? '<span class="badge badge-info">Sim</span>' : '<span class="badge badge-secondary">Não</span>'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Criado em: </span>
                            <?php if ($produto->criado_em): ?>
                                <?php echo esc($produto->criado_em->humanize()); ?>
                            <?php else: ?>
                                <span class="text-muted">Não informado</span>
                            <?php endif; ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Última atualização: </span>
                            <?php if ($produto->atualizado_em): ?>
                                <?php echo esc($produto->atualizado_em->humanize()); ?>
                            <?php else: ?>
                                <span class="text-muted">Não informado</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-actions">
                    <a href="<?php echo site_url('admin/produtos'); ?>" class="btn btn-secondary btn-sm">
                        <i class="mdi mdi-arrow-left"></i> Voltar
                    </a>
                    <a href="<?php echo site_url('admin/produtos/editar/' . $produto->id); ?>" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-pencil"></i> Editar
                    </a>
                    <a href="<?php echo site_url('admin/produtos/extras/' . $produto->id); ?>" class="btn btn-info btn-sm">
                        <i class="mdi mdi-plus-circle"></i> Extras
                    </a>
                    <a href="<?php echo site_url('admin/produtos/especificacoes/' . $produto->id); ?>" class="btn btn-warning btn-sm">
                        <i class="mdi mdi-list-box"></i> Especificações
                    </a>
                    <a href="<?php echo site_url('admin/produtos/medidas/' . $produto->id); ?>" class="btn btn-purple btn-sm">
                        <i class="mdi mdi-ruler"></i> Medidas
                    </a>
                    <?php if ($produto->deletado_em === null): ?>
                        <a href="<?php echo site_url('admin/produtos/excluir/' . $produto->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                            <i class="mdi mdi-delete"></i> Excluir
                        </a>
                    <?php else: ?>
                        <a href="<?php echo site_url('admin/produtos/restaurar/' . $produto->id); ?>" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-restore"></i> Restaurar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>