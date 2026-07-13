<?php

/**
 * Partial: Tabela de produtos
 */
?>

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
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="mdi mdi-package-off" style="font-size: 1.5rem; display: block; margin-bottom: 10px;"></i>
                        Nenhum produto encontrado
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto->id; ?></td>
                        <td>
                            <img src="<?php echo $produto->getImagemThumb(); ?>"
                                alt="<?php echo $produto->nome; ?>"
                                class="produto-imagem-thumb">
                        </td>
                        <td>
                            <a href="<?php echo site_url("admin/produtos/show/{$produto->id}"); ?>">
                                <?php echo $produto->nome; ?>
                            </a>
                        </td>
                        <td><?php echo $produto->categoria_nome; ?></td>
                        <td>
                            <?php if ($produto->preco_promocional): ?>
                                <span class="preco-original">R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?></span><br>
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