<?php

/**
 * Partial: Botões de ação
 * 
 * @var object $usuario Objeto do usuário
 */
?>

<?php if ($usuario->deletado_em !== null): ?>
    <!-- 🔥 USUÁRIO EXCLUÍDO -->
    <div class="btn-group btn-group-sm" role="group">
        <a href="<?php echo site_url("admin/usuarios/show/{$usuario->id}"); ?>"
            class="btn btn-info"
            title="Ver detalhes">
            <i class="mdi mdi-eye"></i>
        </a>
        <a href="<?php echo site_url("admin/usuarios/restaurar/{$usuario->id}"); ?>"
            class="btn btn-success"
            title="Restaurar usuário"
            onclick="return confirm('Tem certeza que deseja restaurar este usuário?')">
            <i class="mdi mdi-restore"></i>
        </a>
    </div>
<?php else: ?>
    <!-- 🔥 USUÁRIO ATIVO -->
    <div class="btn-group btn-group-sm" role="group">
        <a href="<?php echo site_url("admin/usuarios/show/{$usuario->id}"); ?>"
            class="btn btn-info"
            title="Ver detalhes">
            <i class="mdi mdi-eye"></i>
        </a>
        <a href="<?php echo site_url("admin/usuarios/editar/{$usuario->id}"); ?>"
            class="btn btn-primary"
            title="Editar usuário">
            <i class="mdi mdi-pencil"></i>
        </a>
        <a href="<?php echo site_url("admin/usuarios/excluir/{$usuario->id}"); ?>"
            class="btn btn-danger"
            title="Excluir usuário"
            onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
            <i class="mdi mdi-delete"></i>
        </a>
    </div>
<?php endif; ?>