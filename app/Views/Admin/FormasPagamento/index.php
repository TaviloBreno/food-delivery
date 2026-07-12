<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><?php echo $titulo; ?></h4>
                    <a href="<?php echo site_url('admin/formas-pagamento/criar'); ?>" class="btn btn-success btn-sm">
                        <i class="mdi mdi-plus"></i> Nova forma de pagamento
                    </a>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                    <span class="text-muted" style="font-size: 13px;">Total: <strong><?php echo $total ?? 0; ?></strong></span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ícone</th>
                                <th>Nome</th>
                                <th>Taxa</th>
                                <th>Parcelas</th>
                                <th>Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($formas)): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">
                                        <i class="mdi mdi-credit-card-off" style="font-size: 1.5rem; display: block; margin-bottom: 5px;"></i>
                                        Nenhuma forma de pagamento encontrada
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($formas as $forma): ?>
                                    <tr>
                                        <td><?php echo $forma->id; ?></td>
                                        <td>
                                            <i class="mdi <?php echo $forma->icone ?? 'mdi-credit-card'; ?>" style="font-size: 1.5rem;"></i>
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url("admin/formas-pagamento/show/{$forma->id}"); ?>">
                                                <?php echo $forma->nome; ?>
                                            </a>
                                        </td>
                                        <td><?php echo number_format($forma->taxa, 2, ',', '.') . '%'; ?></td>
                                        <td><?php echo $forma->parcelas; ?>x</td>
                                        <td>
                                            <?php if ($forma->deletado_em !== null): ?>
                                                <span class="badge badge-danger">Excluído</span>
                                            <?php elseif ($forma->ativo == 1): ?>
                                                <span class="badge badge-success">Ativo</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Inativo</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($forma->deletado_em !== null): ?>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?php echo site_url("admin/formas-pagamento/show/{$forma->id}"); ?>" class="btn btn-info" title="Ver">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/formas-pagamento/restaurar/{$forma->id}"); ?>" class="btn btn-success" title="Restaurar" onclick="return confirm('Tem certeza que deseja restaurar?')">
                                                        <i class="mdi mdi-restore"></i>
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?php echo site_url("admin/formas-pagamento/show/{$forma->id}"); ?>" class="btn btn-info" title="Ver">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/formas-pagamento/editar/{$forma->id}"); ?>" class="btn btn-primary" title="Editar">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/formas-pagamento/excluir/{$forma->id}"); ?>" class="btn btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir?')">
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
                                        <a class="page-link" href="<?php echo $details['previous'] !== null ? site_url('admin/formas-pagamento?page=' . $details['previous'] . '&perPage=' . ($perPage ?? 10)) : '#'; ?>">
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
                                            <a class="page-link" href="<?php echo site_url('admin/formas-pagamento?page=1&perPage=' . ($perPage ?? 10)); ?>">1</a>
                                        </li>
                                        <?php if ($start > 2): ?>
                                            <li class="page-item disabled">
                                                <span class="page-link">…</span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php for ($i = $start; $i <= $end; $i++): ?>
                                        <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                                            <a class="page-link" href="<?php echo site_url('admin/formas-pagamento?page=' . $i . '&perPage=' . ($perPage ?? 10)); ?>">
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
                                            <a class="page-link" href="<?php echo site_url('admin/formas-pagamento?page=' . $pageCount . '&perPage=' . ($perPage ?? 10)); ?>">
                                                <?php echo $pageCount; ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <li class="page-item <?php echo $details['next'] === null ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="<?php echo $details['next'] !== null ? site_url('admin/formas-pagamento?page=' . $details['next'] . '&perPage=' . ($perPage ?? 10)) : '#'; ?>">
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