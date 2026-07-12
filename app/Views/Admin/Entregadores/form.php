<?php
$isEdit = isset($entregador) && isset($entregador->id);
$action = $isEdit ? site_url('admin/entregadores/atualizar/' . $entregador->id) : site_url('admin/entregadores/salvar');
$buttonText = $isEdit ? 'Salvar alterações' : 'Criar entregador';
$buttonIcon = $isEdit ? 'mdi-content-save' : 'mdi-account-plus';

$errors = session('errors') ?? [];
$old = session('old') ?? [];

$ativoValue = old('ativo') !== null ? old('ativo') : ($entregador->ativo ?? 1);
$disponivelValue = old('disponivel') !== null ? old('disponivel') : ($entregador->disponivel ?? 1);
?>

<form class="forms-sample" action="<?php echo $action; ?>" method="POST" novalidate>
    <?php echo csrf_field(); ?>

    <?php if ($isEdit): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome completo <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['nome']) ? 'is-invalid' : ''; ?>"
                    id="nome"
                    name="nome"
                    value="<?php echo old('nome', esc($entregador->nome ?? '')); ?>"
                    placeholder="Digite o nome completo"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['nome'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['nome']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">E-mail <span class="text-danger">*</span></label>
                <input type="email"
                    class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                    id="email"
                    name="email"
                    value="<?php echo old('email', esc($entregador->email ?? '')); ?>"
                    placeholder="Digite o e-mail"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text"
                    class="form-control masked-input <?php echo isset($errors['cpf']) ? 'is-invalid' : ''; ?>"
                    id="cpf"
                    name="cpf"
                    value="<?php echo old('cpf', esc($entregador->cpf ?? '')); ?>"
                    placeholder="Digite o CPF"
                    autocomplete="off">
                <?php if (isset($errors['cpf'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['cpf']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control masked-input <?php echo isset($errors['telefone']) ? 'is-invalid' : ''; ?>"
                    id="telefone"
                    name="telefone"
                    value="<?php echo old('telefone', esc($entregador->telefone ?? '')); ?>"
                    placeholder="Digite o telefone"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['telefone'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['telefone']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="cnh">CNH</label>
                <input type="text"
                    class="form-control <?php echo isset($errors['cnh']) ? 'is-invalid' : ''; ?>"
                    id="cnh"
                    name="cnh"
                    value="<?php echo old('cnh', esc($entregador->cnh ?? '')); ?>"
                    placeholder="Número da CNH"
                    autocomplete="off">
                <?php if (isset($errors['cnh'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['cnh']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="placa_veiculo">Placa do Veículo</label>
                <input type="text"
                    class="form-control <?php echo isset($errors['placa_veiculo']) ? 'is-invalid' : ''; ?>"
                    id="placa_veiculo"
                    name="placa_veiculo"
                    value="<?php echo old('placa_veiculo', esc($entregador->placa_veiculo ?? '')); ?>"
                    placeholder="AAA-0000"
                    autocomplete="off">
                <?php if (isset($errors['placa_veiculo'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['placa_veiculo']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="modelo_veiculo">Modelo do Veículo</label>
                <input type="text"
                    class="form-control <?php echo isset($errors['modelo_veiculo']) ? 'is-invalid' : ''; ?>"
                    id="modelo_veiculo"
                    name="modelo_veiculo"
                    value="<?php echo old('modelo_veiculo', esc($entregador->modelo_veiculo ?? '')); ?>"
                    placeholder="Ex: Honda CG 150"
                    autocomplete="off">
                <?php if (isset($errors['modelo_veiculo'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['modelo_veiculo']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="cor_veiculo">Cor do Veículo</label>
                <input type="text"
                    class="form-control <?php echo isset($errors['cor_veiculo']) ? 'is-invalid' : ''; ?>"
                    id="cor_veiculo"
                    name="cor_veiculo"
                    value="<?php echo old('cor_veiculo', esc($entregador->cor_veiculo ?? '')); ?>"
                    placeholder="Ex: Vermelha"
                    autocomplete="off">
                <?php if (isset($errors['cor_veiculo'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['cor_veiculo']; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Status <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label">
                                <input type="radio"
                                    class="form-check-input"
                                    name="ativo"
                                    value="1"
                                    <?php echo $ativoValue == 1 ? 'checked' : ''; ?>>
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
                                    value="0"
                                    <?php echo $ativoValue == 0 ? 'checked' : ''; ?>>
                                Inativo
                            </label>
                        </div>
                    </div>
                </div>
                <?php if (isset($errors['ativo'])): ?>
                    <div class="invalid-feedback d-block"><?php echo $errors['ativo']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Disponibilidade <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check form-check-success">
                            <label class="form-check-label">
                                <input type="radio"
                                    class="form-check-input"
                                    name="disponivel"
                                    value="1"
                                    <?php echo $disponivelValue == 1 ? 'checked' : ''; ?>>
                                Disponível
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check form-check-secondary">
                            <label class="form-check-label">
                                <input type="radio"
                                    class="form-check-input"
                                    name="disponivel"
                                    value="0"
                                    <?php echo $disponivelValue == 0 ? 'checked' : ''; ?>>
                                Indisponível
                            </label>
                        </div>
                    </div>
                </div>
                <?php if (isset($errors['disponivel'])): ?>
                    <div class="invalid-feedback d-block"><?php echo $errors['disponivel']; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-2">
            <i class="mdi <?php echo $buttonIcon; ?>"></i> <?php echo $buttonText; ?>
        </button>
        <a href="<?php echo site_url('admin/entregadores'); ?>" class="btn btn-danger ml-2">
            <i class="mdi mdi-arrow-left"></i> Cancelar
        </a>
        <?php if ($isEdit): ?>
            <a href="<?php echo site_url('admin/entregadores/show/' . $entregador->id); ?>" class="btn btn-info ml-2">
                <i class="mdi mdi-eye"></i> Ver detalhes
            </a>
        <?php endif; ?>
    </div>
</form>