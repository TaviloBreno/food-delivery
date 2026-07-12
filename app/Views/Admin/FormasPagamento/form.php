<?php
$isEdit = isset($forma) && isset($forma->id);
$action = $isEdit ? site_url('admin/formas-pagamento/atualizar/' . $forma->id) : site_url('admin/formas-pagamento/salvar');
$buttonText = $isEdit ? 'Salvar alterações' : 'Criar forma de pagamento';
$buttonIcon = $isEdit ? 'mdi-content-save' : 'mdi-plus';

$errors = session('errors') ?? [];
$ativoValue = old('ativo') !== null ? old('ativo') : ($forma->ativo ?? 1);
?>

<form class="forms-sample" action="<?php echo $action; ?>" method="POST" novalidate>
    <?php echo csrf_field(); ?>

    <?php if ($isEdit): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['nome']) ? 'is-invalid' : ''; ?>"
                    id="nome"
                    name="nome"
                    value="<?php echo old('nome', esc($forma->nome ?? '')); ?>"
                    placeholder="Ex: Cartão de Crédito"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['nome'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['nome']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="icone">Ícone</label>
                <input type="text"
                    class="form-control <?php echo isset($errors['icone']) ? 'is-invalid' : ''; ?>"
                    id="icone"
                    name="icone"
                    value="<?php echo old('icone', esc($forma->icone ?? '')); ?>"
                    placeholder="Ex: mdi-credit-card"
                    autocomplete="off">
                <small class="text-muted">Use um ícone do Material Design Icons (mdi-*)</small>
                <?php if (isset($errors['icone'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['icone']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="taxa">Taxa (%) <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['taxa']) ? 'is-invalid' : ''; ?>"
                    id="taxa"
                    name="taxa"
                    value="<?php echo old('taxa', number_format($forma->taxa ?? 0, 2, ',', '.')); ?>"
                    placeholder="0,00"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['taxa'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['taxa']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="parcelas">Parcelas <span class="text-danger">*</span></label>
                <input type="number"
                    class="form-control <?php echo isset($errors['parcelas']) ? 'is-invalid' : ''; ?>"
                    id="parcelas"
                    name="parcelas"
                    value="<?php echo old('parcelas', esc($forma->parcelas ?? 1)); ?>"
                    placeholder="1"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['parcelas'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['parcelas']; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control <?php echo isset($errors['descricao']) ? 'is-invalid' : ''; ?>"
            id="descricao"
            name="descricao"
            rows="3"
            placeholder="Digite uma descrição da forma de pagamento"><?php echo old('descricao', esc($forma->descricao ?? '')); ?></textarea>
        <?php if (isset($errors['descricao'])): ?>
            <div class="invalid-feedback"><?php echo $errors['descricao']; ?></div>
        <?php endif; ?>
    </div>

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

    <hr>

    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-2">
            <i class="mdi <?php echo $buttonIcon; ?>"></i> <?php echo $buttonText; ?>
        </button>
        <a href="<?php echo site_url('admin/formas-pagamento'); ?>" class="btn btn-danger ml-2">
            <i class="mdi mdi-arrow-left"></i> Cancelar
        </a>
        <?php if ($isEdit): ?>
            <a href="<?php echo site_url('admin/formas-pagamento/show/' . $forma->id); ?>" class="btn btn-info ml-2">
                <i class="mdi mdi-eye"></i> Ver detalhes
            </a>
        <?php endif; ?>
    </div>
</form>