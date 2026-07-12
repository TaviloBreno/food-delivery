<?php
$isEdit = isset($categoria) && isset($categoria->id);
$action = $isEdit ? site_url('admin/categorias/atualizar/' . $categoria->id) : site_url('admin/categorias/salvar');
$buttonText = $isEdit ? 'Salvar alterações' : 'Criar categoria';
$buttonIcon = $isEdit ? 'mdi-content-save' : 'mdi-plus';

$errors = session('errors') ?? [];
?>

<form class="forms-sample" action="<?php echo $action; ?>" method="POST" novalidate>
    <?php echo csrf_field(); ?>

    <?php if ($isEdit): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="nome">Nome da categoria <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['nome']) ? 'is-invalid' : ''; ?>"
                    id="nome"
                    name="nome"
                    value="<?php echo old('nome', esc($categoria->nome ?? '')); ?>"
                    placeholder="Digite o nome da categoria"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['nome'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['nome']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="icone">Ícone <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['icone']) ? 'is-invalid' : ''; ?>"
                    id="icone"
                    name="icone"
                    value="<?php echo old('icone', esc($categoria->icone ?? '')); ?>"
                    placeholder="Ex: mdi-food"
                    autocomplete="off">
                <small class="text-muted">Use um ícone do Material Design Icons (mdi-*)</small>
                <?php if (isset($errors['icone'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['icone']; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control <?php echo isset($errors['descricao']) ? 'is-invalid' : ''; ?>"
            id="descricao"
            name="descricao"
            rows="4"
            placeholder="Digite uma descrição para a categoria"><?php echo old('descricao', esc($categoria->descricao ?? '')); ?></textarea>
        <?php if (isset($errors['descricao'])): ?>
            <div class="invalid-feedback"><?php echo $errors['descricao']; ?></div>
        <?php endif; ?>
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
                                    <?php echo (old('ativo') == 1 || (isset($categoria->ativo) && $categoria->ativo == 1) || (!old('ativo') && !$isEdit)) ? 'checked' : ''; ?>>
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
                                    <?php echo (old('ativo') == 0 || (isset($categoria->ativo) && $categoria->ativo == 0)) ? 'checked' : ''; ?>>
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
    </div>

    <hr>

    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-2">
            <i class="mdi <?php echo $buttonIcon; ?>"></i> <?php echo $buttonText; ?>
        </button>
        <a href="<?php echo site_url('admin/categorias'); ?>" class="btn btn-danger ml-2">
            <i class="mdi mdi-arrow-left"></i> Cancelar
        </a>
        <?php if ($isEdit): ?>
            <a href="<?php echo site_url('admin/categorias/show/' . $categoria->id); ?>" class="btn btn-info ml-2">
                <i class="mdi mdi-eye"></i> Ver detalhes
            </a>
        <?php endif; ?>
    </div>
</form>