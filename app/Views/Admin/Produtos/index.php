<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('admin/css/produtos.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><?php echo $titulo; ?></h4>
                    <a href="<?php echo site_url('admin/produtos/criar'); ?>" class="btn btn-success btn-sm">
                        <i class="mdi mdi-plus"></i> Novo produto
                    </a>
                </div>

                <div class="ui-widget">
                    <input id="query" name="query" placeholder="Pesquise por um produto" class="form-control bg-light">
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                    <span class="text-muted" style="font-size: 13px;">Total de produtos: <strong><?php echo $total ?? 0; ?></strong></span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-produtos">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                                <th>Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($produtos)): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">
                                        <i class="mdi mdi-package-off" style="font-size: 1.5rem; display: block; margin-bottom: 5px;"></i>
                                        Nenhum produto encontrado
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($produtos as $produto): ?>
                                    <tr>
                                        <td><?php echo $produto->id; ?></td>
                                        <td>
                                            <img src="<?php echo $produto->getImagemUrl(); ?>" alt="<?php echo $produto->nome; ?>" class="produto-imagem-thumb">
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url("admin/produtos/show/{$produto->id}"); ?>">
                                                <?php echo $produto->nome; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $produto->categoria_nome; ?></td>
                                        <td>
                                            <?php if ($produto->preco_promocional): ?>
                                                <span class="preco-original">R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?></span>
                                                <span class="preco-promocional">R$ <?php echo number_format($produto->preco_promocional, 2, ',', '.'); ?></span>
                                            <?php else: ?>
                                                <span>R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($produto->deletado_em !== null): ?>
                                                <span class="badge badge-danger">Excluído</span>
                                            <?php elseif ($produto->ativo == 1): ?>
                                                <span class="badge badge-success">Ativo</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Inativo</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($produto->deletado_em !== null): ?>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?php echo site_url("admin/produtos/show/{$produto->id}"); ?>" class="btn btn-info" title="Ver">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/produtos/restaurar/{$produto->id}"); ?>" class="btn btn-success" title="Restaurar" onclick="return confirm('Tem certeza que deseja restaurar este produto?')">
                                                        <i class="mdi mdi-restore"></i>
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?php echo site_url("admin/produtos/show/{$produto->id}"); ?>" class="btn btn-info" title="Ver">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/produtos/editar/{$produto->id}"); ?>" class="btn btn-primary" title="Editar">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/produtos/upload-imagem/{$produto->id}"); ?>" class="btn btn-warning" title="Upload imagem">
                                                        <i class="mdi mdi-camera"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/produtos/excluir/{$produto->id}"); ?>" class="btn btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (!empty($pager)): ?>
                    <?php $details = $pager->getDetails('default'); ?>
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Mostrando <strong><?php echo $details['currentPage']; ?></strong> de
                            <strong><?php echo $details['pageCount']; ?></strong> páginas
                            <span class="text-muted">(<?php echo $total ?? 0; ?> registros)</span>
                        </div>
                        <div class="pagination-wrapper">
                            <div class="page-size-select">
                                <label for="perPage">Mostrar:</label>
                                <select id="perPage">
                                    <option value="5" <?php echo ($perPage ?? 10) == 5 ? 'selected' : ''; ?>>5</option>
                                    <option value="10" <?php echo ($perPage ?? 10) == 10 ? 'selected' : ''; ?>>10</option>
                                    <option value="15" <?php echo ($perPage ?? 10) == 15 ? 'selected' : ''; ?>>15</option>
                                </select>
                            </div>
                            <nav aria-label="Navegação de páginas">
                                <ul class="pagination-custom">
                                    <!-- ... paginação ... -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    window.autocompleteUrl = "<?php echo site_url('admin/produtos/procurar'); ?>";
    window.showUrl = "<?php echo site_url('admin/produtos/show'); ?>";
</script>
<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>
<script src="<?php echo site_url('admin/js/produtos.js'); ?>"></script>
<?php echo $this->endSection(); ?>