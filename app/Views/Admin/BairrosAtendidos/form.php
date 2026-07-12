<?php
$isEdit = isset($bairro) && isset($bairro->id);
$action = $isEdit ? site_url('admin/bairros-atendidos/atualizar/' . $bairro->id) : site_url('admin/bairros-atendidos/salvar');
$buttonText = $isEdit ? 'Salvar alterações' : 'Criar bairro';
$buttonIcon = $isEdit ? 'mdi-content-save' : 'mdi-plus';

$errors = session('errors') ?? [];
$old = session('old') ?? [];

$ativoValue = old('ativo') !== null ? old('ativo') : ($bairro->ativo ?? 1);
?>

<form class="forms-sample" action="<?php echo $action; ?>" method="POST" novalidate>
    <?php echo csrf_field(); ?>

    <?php if ($isEdit): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome do bairro <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['nome']) ? 'is-invalid' : ''; ?>"
                    id="nome"
                    name="nome"
                    value="<?php echo old('nome', esc($bairro->nome ?? '')); ?>"
                    placeholder="Ex: Centro"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['nome'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['nome']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="taxa_entrega">Taxa de entrega (R$) <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['taxa_entrega']) ? 'is-invalid' : ''; ?>"
                    id="taxa_entrega"
                    name="taxa_entrega"
                    value="<?php echo old('taxa_entrega', number_format($bairro->taxa_entrega ?? 0, 2, ',', '.')); ?>"
                    placeholder="0,00"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['taxa_entrega'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['taxa_entrega']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tempo_medio">Tempo médio de entrega (min) <span class="text-danger">*</span></label>
                <input type="number"
                    class="form-control <?php echo isset($errors['tempo_medio']) ? 'is-invalid' : ''; ?>"
                    id="tempo_medio"
                    name="tempo_medio"
                    value="<?php echo old('tempo_medio', esc($bairro->tempo_medio ?? 30)); ?>"
                    placeholder="30"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['tempo_medio'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['tempo_medio']; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="cidade">Cidade <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['cidade']) ? 'is-invalid' : ''; ?>"
                    id="cidade"
                    name="cidade"
                    value="<?php echo old('cidade', esc($bairro->cidade ?? 'Crateús')); ?>"
                    placeholder="Ex: Crateús"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['cidade'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['cidade']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="estado">Estado <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['estado']) ? 'is-invalid' : ''; ?>"
                    id="estado"
                    name="estado"
                    value="<?php echo old('estado', esc($bairro->estado ?? 'CE')); ?>"
                    placeholder="Ex: CE"
                    autocomplete="off"
                    maxlength="2"
                    required>
                <?php if (isset($errors['estado'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['estado']; ?></div>
                <?php endif; ?>
            </div>
        </div>
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
        <a href="<?php echo site_url('admin/bairros-atendidos'); ?>" class="btn btn-danger ml-2">
            <i class="mdi mdi-arrow-left"></i> Cancelar
        </a>
        <?php if ($isEdit): ?>
            <a href="<?php echo site_url('admin/bairros-atendidos/show/' . $bairro->id); ?>" class="btn btn-info ml-2">
                <i class="mdi mdi-eye"></i> Ver detalhes
            </a>
        <?php endif; ?>
    </div>
</form>