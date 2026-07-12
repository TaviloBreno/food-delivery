<?php

/**
 * Partial: Tabela de listagem
 * 
 * @var array  $usuarios   Lista de usuários
 * @var string $classe     Classe adicional (opcional)
 * @var array  $colunas    Colunas personalizadas (opcional)
 */
?>

<div class="table-responsive">
    <table class="table table-hover <?php echo $classe ?? 'table-usuarios'; ?>">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Status</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($usuarios)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="mdi mdi-account-off" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                        Nenhum usuário encontrado
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario->id; ?></td>
                        <td>
                            <a href="<?php echo site_url("admin/usuarios/show/{$usuario->id}"); ?>">
                                <?php echo $usuario->nome; ?>
                            </a>
                        </td>
                        <td><?php echo formataCpf($usuario->cpf); ?></td>
                        <td><?php echo formataTelefone($usuario->telefone); ?></td>
                        <td>
                            <?php if ($usuario->deletado_em !== null): ?>
                                <span class="badge badge-danger">Excluído</span>
                            <?php elseif ($usuario->ativo == 1): ?>
                                <span class="badge badge-success">Ativo</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Inativo</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php echo view('Admin/Usuarios/partials/_botoes_acao', ['usuario' => $usuario]); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>