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

// 🔥 PEGA OS ERROS DA SESSÃO
$errors = session('errors') ?? [];
$old = session('old') ?? [];
?>

<form class="forms-sample" action="<?php echo $action; ?>" method="POST" novalidate>

    <?php echo csrf_field(); ?>

    <?php if ($isEdit): ?>
        <input type="hidden" name="_method" value="<?php echo $method; ?>">
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome completo <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['nome']) ? 'is-invalid' : ''; ?>"
                    id="nome"
                    name="nome"
                    value="<?php echo old('nome', esc($usuario->nome ?? '')); ?>"
                    placeholder="Digite o nome completo"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['nome'])): ?>
                    <div class="invalid-feedback">
                        <?php echo $errors['nome']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email"
                    class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                    id="email"
                    name="email"
                    value="<?php echo old('email', esc($usuario->email ?? '')); ?>"
                    placeholder="Digite o email"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback">
                        <?php echo $errors['email']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="cpf">CPF <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control masked-input <?php echo isset($errors['cpf']) ? 'is-invalid' : ''; ?>"
                    id="cpf"
                    name="cpf"
                    value="<?php echo old('cpf', esc($usuario->cpf ?? '')); ?>"
                    placeholder="Digite o CPF (apenas números)"
                    autocomplete="off"
                    required>
                <small class="text-muted">Digite apenas os 11 números do CPF. Exemplo: 12345678901</small>
                <?php if (isset($errors['cpf'])): ?>
                    <div class="invalid-feedback">
                        <?php echo $errors['cpf']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control masked-input <?php echo isset($errors['telefone']) ? 'is-invalid' : ''; ?>"
                    id="telefone"
                    name="telefone"
                    value="<?php echo old('telefone', esc($usuario->telefone ?? '')); ?>"
                    placeholder="Digite o telefone com DDD"
                    autocomplete="off"
                    required>
                <small class="text-muted">Digite o DDD + número. Exemplo: 11988887777</small>
                <?php if (isset($errors['telefone'])): ?>
                    <div class="invalid-feedback">
                        <?php echo $errors['telefone']; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="senha"><?php echo $senhaLabel; ?> <span class="text-danger">*</span></label>
                <input type="password"
                    class="form-control <?php echo isset($errors['senha']) ? 'is-invalid' : ''; ?>"
                    id="senha"
                    name="senha"
                    placeholder="<?php echo $senhaPlaceholder; ?>"
                    autocomplete="off"
                    <?php echo $senhaRequired; ?>>
                <small class="text-muted">A senha deve ter no mínimo 8 caracteres</small>
                <?php if (isset($errors['senha'])): ?>
                    <div class="invalid-feedback">
                        <?php echo $errors['senha']; ?>
                    </div>
                <?php endif; ?>
                <?php echo $senhaHelp; ?>
            </div>

            <div class="form-group">
                <label for="senha_confirmacao">Confirmar senha <span class="text-danger">*</span></label>
                <input type="password"
                    class="form-control <?php echo isset($errors['senha_confirmacao']) ? 'is-invalid' : ''; ?>"
                    id="senha_confirmacao"
                    name="senha_confirmacao"
                    placeholder="Confirme a senha"
                    autocomplete="off"
                    <?php echo $senhaRequired; ?>>
                <?php if (isset($errors['senha_confirmacao'])): ?>
                    <div class="invalid-feedback">
                        <?php echo $errors['senha_confirmacao']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Status <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check form-check-primary <?php echo isset($errors['ativo']) ? 'is-invalid' : ''; ?>">
                            <label class="form-check-label">
                                <input type="radio"
                                    class="form-check-input"
                                    name="ativo"
                                    id="ativoSim"
                                    value="1"
                                    <?php echo (old('ativo') == 1 || (isset($usuario->ativo) && $usuario->ativo == 1) || (!old('ativo') && !$isEdit)) ? 'checked' : ''; ?>>
                                Ativo
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check form-check-danger <?php echo isset($errors['ativo']) ? 'is-invalid' : ''; ?>">
                            <label class="form-check-label">
                                <input type="radio"
                                    class="form-check-input"
                                    name="ativo"
                                    id="ativoNao"
                                    value="0"
                                    <?php echo (old('ativo') == 0 || (isset($usuario->ativo) && $usuario->ativo == 0)) ? 'checked' : ''; ?>>
                                Inativo
                            </label>
                        </div>
                    </div>
                </div>
                <?php if (isset($errors['ativo'])): ?>
                    <div class="invalid-feedback d-block">
                        <?php echo $errors['ativo']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Permissão <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check form-check-primary <?php echo isset($errors['is_admin']) ? 'is-invalid' : ''; ?>">
                            <label class="form-check-label">
                                <input type="radio"
                                    class="form-check-input"
                                    name="is_admin"
                                    id="isAdminSim"
                                    value="1"
                                    <?php echo (old('is_admin') == 1 || (isset($usuario->is_admin) && $usuario->is_admin == 1)) ? 'checked' : ''; ?>>
                                Administrador
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check form-check-secondary <?php echo isset($errors['is_admin']) ? 'is-invalid' : ''; ?>">
                            <label class="form-check-label">
                                <input type="radio"
                                    class="form-check-input"
                                    name="is_admin"
                                    id="isAdminNao"
                                    value="0"
                                    <?php echo (old('is_admin') == 0 || (isset($usuario->is_admin) && $usuario->is_admin == 0) || (!old('is_admin') && !$isEdit)) ? 'checked' : ''; ?>>
                                Usuário comum
                            </label>
                        </div>
                    </div>
                </div>
                <?php if (isset($errors['is_admin'])): ?>
                    <div class="invalid-feedback d-block">
                        <?php echo $errors['is_admin']; ?>
                    </div>
                <?php endif; ?>
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