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
                    <a href="<?php echo site_url('admin/entregadores/criar'); ?>" class="btn btn-success btn-sm">
                        <i class="mdi mdi-plus"></i> Novo entregador
                    </a>
                </div>

                <div class="ui-widget">
                    <input id="query" name="query" placeholder="Pesquise por um entregador" class="form-control bg-light">
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                    <span class="text-muted" style="font-size: 13px;">Total: <strong><?php echo $total ?? 0; ?></strong></span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Veículo</th>
                                <th>Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($entregadores)): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">
                                        <i class="mdi mdi-motorbike-off" style="font-size: 1.5rem; display: block; margin-bottom: 5px;"></i>
                                        Nenhum entregador encontrado
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($entregadores as $entregador): ?>
                                    <tr>
                                        <td><?php echo $entregador->id; ?></td>
                                        <td>
                                            <img src="<?php echo $entregador->getFotoUrl(); ?>"
                                                alt="<?php echo $entregador->nome; ?>"
                                                style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url("admin/entregadores/show/{$entregador->id}"); ?>">
                                                <?php echo $entregador->nome; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $entregador->telefone; ?></td>
                                        <td>
                                            <?php if ($entregador->modelo_veiculo): ?>
                                                <?php echo $entregador->modelo_veiculo; ?>
                                                <?php if ($entregador->placa_veiculo): ?>
                                                    <br><small class="text-muted"><?php echo $entregador->placa_veiculo; ?></small>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-muted">Não informado</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($entregador->deletado_em !== null): ?>
                                                <span class="badge badge-danger">Excluído</span>
                                            <?php elseif ($entregador->ativo == 0): ?>
                                                <span class="badge badge-warning">Inativo</span>
                                            <?php elseif ($entregador->disponivel == 0): ?>
                                                <span class="badge badge-secondary">Indisponível</span>
                                            <?php else: ?>
                                                <span class="badge badge-success">Disponível</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($entregador->deletado_em !== null): ?>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?php echo site_url("admin/entregadores/show/{$entregador->id}"); ?>" class="btn btn-info" title="Ver">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/entregadores/restaurar/{$entregador->id}"); ?>" class="btn btn-success" title="Restaurar" onclick="return confirm('Tem certeza que deseja restaurar?')">
                                                        <i class="mdi mdi-restore"></i>
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?php echo site_url("admin/entregadores/show/{$entregador->id}"); ?>" class="btn btn-info" title="Ver">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/entregadores/editar/{$entregador->id}"); ?>" class="btn btn-primary" title="Editar">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/entregadores/upload-foto/{$entregador->id}"); ?>" class="btn btn-warning" title="Upload foto">
                                                        <i class="mdi mdi-camera"></i>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/entregadores/excluir/{$entregador->id}"); ?>" class="btn btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir?')">
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