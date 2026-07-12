<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><?php echo $titulo; ?></h4>
                    <a href="<?php echo site_url('admin/bairros-atendidos/criar'); ?>" class="btn btn-success btn-sm">
                        <i class="mdi mdi-plus"></i> Novo bairro
                    </a>
                </div>

                <div class="ui-widget">
                    <input id="query" name="query" placeholder="Pesquise por um bairro" class="form-control bg-light">
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                    <span class="text-muted" style="font-size: 13px;">Total: <strong><?php echo $total ?? 0; ?></strong></span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Taxa Entrega</th>
                                <th>Tempo Médio</th>
                                <th>Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($bairros)): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">
                                        <i class="mdi mdi-map-marker-off" style="font-size: 1.5rem; display: block; margin-bottom: 5px;"></i>
                                        Nenhum bairro cadastrado
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($bairros as $bairro): ?>
                                    <tr>
                                        <td><?php echo $bairro->id; ?></td>
                                        <td>
                                            <a href="<?php echo site_url("admin/bairros-atendidos/show/{$bairro->id}"); ?>">
                                                <?php echo $bairro->nome; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $bairro->cidade . '/' . $bairro->estado; ?></td>
                                        <td>R$ <?php echo number_format($bairro->taxa_entrega, 2, ',', '.'); ?></td>
                                        <td><?php echo $bairro->tempo_medio; ?> min</td>
                                        <td>
                                            <?php if ($bairro->deletado_em !== null): ?>
                                                <span class="badge badge-danger">Excluído</span>
                                            <?php elseif ($bairro->ativo == 1): ?>
                                                <span class="badge badge-success">Ativo</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Inativo</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($bairro->deletado_em !== null): ?>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?php echo site_url("admin/bairros-atendidos/show/{$bairro->id}"); ?>" class="btn btn-info" title="Ver">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/bairros-atendidos/restaurar/{$bairro->id}"); ?>" class="btn btn-success" title="Restaurar" onclick="return confirm('Tem certeza que deseja restaurar?')">
                                                        <i class="mdi mdi-restore"></i>
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?php echo site_url("admin/bairros-atendidos/show/{$bairro->id}"); ?>" class="btn btn-info" title="Ver">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/bairros-atendidos/editar/{$bairro->id}"); ?>" class="btn btn-primary" title="Editar">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/bairros-atendidos/excluir/{$bairro->id}"); ?>" class="btn btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir?')">
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
                                    <li class="page-item <?php echo $details['previous'] === null ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="<?php echo $details['previous'] !== null ? site_url('admin/bairros-atendidos?page=' . $details['previous'] . '&perPage=' . ($perPage ?? 10)) : '#'; ?>">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    <?php
                                    $currentPage = $details['currentPage'];
                                    $pageCount = $details['pageCount'];
                                    $start = max(1, $currentPage - 2);
                                    $end = min($pageCount, $currentPage + 2);

                                    if ($start > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo site_url('admin/bairros-atendidos?page=1&perPage=' . ($perPage ?? 10)); ?>">1</a>
                                        </li>
                                        <?php if ($start > 2): ?>
                                            <li class="page-item disabled">
                                                <span class="page-link">…</span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php for ($i = $start; $i <= $end; $i++): ?>
                                        <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                                            <a class="page-link" href="<?php echo site_url('admin/bairros-atendidos?page=' . $i . '&perPage=' . ($perPage ?? 10)); ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($end < $pageCount): ?>
                                        <?php if ($end < $pageCount - 1): ?>
                                            <li class="page-item disabled">
                                                <span class="page-link">…</span>
                                            </li>
                                        <?php endif; ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo site_url('admin/bairros-atendidos?page=' . $pageCount . '&perPage=' . ($perPage ?? 10)); ?>">
                                                <?php echo $pageCount; ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <li class="page-item <?php echo $details['next'] === null ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="<?php echo $details['next'] !== null ? site_url('admin/bairros-atendidos?page=' . $details['next'] . '&perPage=' . ($perPage ?? 10)) : '#'; ?>">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
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
    window.autocompleteUrl = "<?php echo site_url('admin/bairros-atendidos/procurar'); ?>";
    window.showUrl = "<?php echo site_url('admin/bairros-atendidos/show'); ?>";
</script>
<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>
<script src="<?php echo site_url('admin/js/usuarios-index.js'); ?>"></script>

<script>
    $(document).ready(function() {
        $('#perPage').on('change', function() {
            var perPage = $(this).val();
            var url = new URL(window.location.href);
            url.searchParams.set('perPage', perPage);
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    });
</script>
<?php echo $this->endSection(); ?>