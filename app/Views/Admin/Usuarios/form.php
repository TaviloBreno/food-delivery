<?php
$isEdit = isset($usuario) && isset($usuario->id);
$action = $isEdit ? site_url('admin/usuarios/atualizar/' . $usuario->id) : site_url('admin/usuarios/salvar');
$method = $isEdit ? 'PUT' : 'POST';
$senhaRequired = $isEdit ? '' : 'required';
$senhaLabel = $isEdit ? 'Nova senha' : 'Senha';
$senhaPlaceholder = $isEdit ? 'Digite a nova senha (opcional)' : 'Digite a senha';
$senhaHelp = $isEdit ? '<small class="text-muted">Deixe em branco para manter a senha atual</small>' : '';
$buttonText = $isEdit ? 'Salvar alterações' : 'Criar usuário';
$buttonIcon = $isEdit ? 'mdi-content-save' : 'mdi-account-plus';
?>

<form class="forms-sample" action="<?php echo $action; ?>" method="POST">
    
    <?php echo csrf_field(); ?>
    
    <?php if ($isEdit): ?>
    <input type="hidden" name="_method" value="<?php echo $method; ?>">
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome completo</label>
                <input type="text" 
                       class="form-control" 
                       id="nome" 
                       name="nome" 
                       value="<?php echo esc($usuario->nome ?? ''); ?>"
                       placeholder="Digite o nome completo"
                       autocomplete="off"
                       required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" 
                       class="form-control" 
                       id="email" 
                       name="email" 
                       value="<?php echo esc($usuario->email ?? ''); ?>"
                       placeholder="Digite o email"
                       autocomplete="off"
                       required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" 
                       class="form-control masked-input" 
                       id="cpf" 
                       name="cpf" 
                       value="<?php echo esc($usuario->cpf ?? ''); ?>"
                       placeholder="Digite o CPF"
                       autocomplete="off">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" 
                       class="form-control masked-input" 
                       id="telefone" 
                       name="telefone" 
                       value="<?php echo esc($usuario->telefone ?? ''); ?>"
                       placeholder="Digite o telefone"
                       autocomplete="off">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="senha"><?php echo $senhaLabel; ?></label>
                <input type="password" 
                       class="form-control" 
                       id="senha" 
                       name="senha" 
                       placeholder="<?php echo $senhaPlaceholder; ?>"
                       autocomplete="off"
                       <?php echo $senhaRequired; ?>>
                <?php echo $senhaHelp; ?>
            </div>

            <div class="form-group">
                <label for="senha_confirmacao">Confirmar senha</label>
                <input type="password" 
                       class="form-control" 
                       id="senha_confirmacao" 
                       name="senha_confirmacao" 
                       placeholder="Confirme a senha"
                       autocomplete="off"
                       <?php echo $senhaRequired; ?>>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label">
                                <input type="radio" 
                                       class="form-check-input" 
                                       name="ativo" 
                                       id="ativoSim" 
                                       value="1"
                                       <?php echo (isset($usuario->ativo) && $usuario->ativo == 1 ? 'checked' : '') . (!$isEdit ? ' checked' : ''); ?>>
                                Ativo
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check form-check-danger">
                            <label class="form-check-label">
                                <input type="radio" 
                                       class="form-check-input" 
                                       name="ativo" 
                                       id="ativoNao" 
                                       value="0"
                                       <?php echo (isset($usuario->ativo) && $usuario->ativo == 0 ? 'checked' : ''); ?>>
                                Inativo
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Permissão</label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label">
                                <input type="radio" 
                                       class="form-check-input" 
                                       name="is_admin" 
                                       id="isAdminSim" 
                                       value="1"
                                       <?php echo (isset($usuario->is_admin) && $usuario->is_admin == 1 ? 'checked' : ''); ?>>
                                Administrador
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check form-check-secondary">
                            <label class="form-check-label">
                                <input type="radio" 
                                       class="form-check-input" 
                                       name="is_admin" 
                                       id="isAdminNao" 
                                       value="0"
                                       <?php echo (isset($usuario->is_admin) && $usuario->is_admin == 0 ? 'checked' : '') . (!$isEdit ? ' checked' : ''); ?>>
                                Usuário comum
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-2">
            <i class="mdi <?php echo $buttonIcon; ?>"></i> <?php echo $buttonText; ?>
        </button>
        <a href="<?php echo site_url('admin/usuarios'); ?>" class="btn btn-danger ml-2">
            <i class="mdi mdi-arrow-left"></i> Cancelar
        </a>
        <?php if ($isEdit): ?>
        <a href="<?php echo site_url('admin/usuarios/show/' . $usuario->id); ?>" class="btn btn-info ml-2">
            <i class="mdi mdi-eye"></i> Ver detalhes
        </a>
        <?php endif; ?>
    </div>
</form>