<?php
$isEdit = isset($produto) && isset($produto->id);
$action = $isEdit ? site_url('admin/produtos/atualizar/' . $produto->id) : site_url('admin/produtos/salvar');
$buttonText = $isEdit ? 'Salvar alterações' : 'Criar produto';
$buttonIcon = $isEdit ? 'mdi-content-save' : 'mdi-plus';

$errors = session('errors') ?? [];
$old = session('old') ?? [];

$ativoValue = old('ativo') !== null ? old('ativo') : ($produto->ativo ?? 1);
$destaqueValue = old('destaque') !== null ? old('destaque') : ($produto->destaque ?? 0);
?>

<form class="forms-sample" action="<?php echo $action; ?>" method="POST" novalidate>
    <?php echo csrf_field(); ?>

    <?php if ($isEdit): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="categoria_id">Categoria <span class="text-danger">*</span></label>
                <select class="form-control <?php echo isset($errors['categoria_id']) ? 'is-invalid' : ''; ?>"
                    id="categoria_id" name="categoria_id" required>
                    <option value="">Selecione uma categoria</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria->id; ?>"
                            <?php echo old('categoria_id', $produto->categoria_id ?? '') == $categoria->id ? 'selected' : ''; ?>>
                            <?php echo $categoria->nome; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['categoria_id'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['categoria_id']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="nome">Nome do produto <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['nome']) ? 'is-invalid' : ''; ?>"
                    id="nome"
                    name="nome"
                    value="<?php echo old('nome', esc($produto->nome ?? '')); ?>"
                    placeholder="Digite o nome do produto"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['nome'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['nome']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="preco">Preço <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control <?php echo isset($errors['preco']) ? 'is-invalid' : ''; ?>"
                    id="preco"
                    name="preco"
                    value="<?php echo old('preco', number_format($produto->preco ?? 0, 2, ',', '.')); ?>"
                    placeholder="0,00"
                    autocomplete="off"
                    required>
                <?php if (isset($errors['preco'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['preco']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="preco_promocional">Preço promocional</label>
                <input type="text"
                    class="form-control <?php echo isset($errors['preco_promocional']) ? 'is-invalid' : ''; ?>"
                    id="preco_promocional"
                    name="preco_promocional"
                    value="<?php echo old('preco_promocional', isset($produto->preco_promocional) ? number_format($produto->preco_promocional, 2, ',', '.') : ''); ?>"
                    placeholder="0,00"
                    autocomplete="off">
                <?php if (isset($errors['preco_promocional'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['preco_promocional']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control <?php echo isset($errors['descricao']) ? 'is-invalid' : ''; ?>"
                    id="descricao"
                    name="descricao"
                    rows="3"
                    placeholder="Digite uma descrição para o produto"><?php echo old('descricao', esc($produto->descricao ?? '')); ?></textarea>
                <?php if (isset($errors['descricao'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['descricao']; ?></div>
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
                <label>Destaque</label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label">
                                <input type="radio"
                                    class="form-check-input"
                                    name="destaque"
                                    value="1"
                                    <?php echo $destaqueValue == 1 ? 'checked' : ''; ?>>
                                Sim
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check form-check-secondary">
                            <label class="form-check-label">
                                <input type="radio"
                                    class="form-check-input"
                                    name="destaque"
                                    value="0"
                                    <?php echo $destaqueValue == 0 ? 'checked' : ''; ?>>
                                Não
                            </label>
                        </div>
                    </div>
                </div>
                <?php if (isset($errors['destaque'])): ?>
                    <div class="invalid-feedback d-block"><?php echo $errors['destaque']; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-2">
            <i class="mdi <?php echo $buttonIcon; ?>"></i> <?php echo $buttonText; ?>
        </button>
        <a href="<?php echo site_url('admin/produtos'); ?>" class="btn btn-danger ml-2">
            <i class="mdi mdi-arrow-left"></i> Cancelar
        </a>
        <?php if ($isEdit): ?>
            <a href="<?php echo site_url('admin/produtos/show/' . $produto->id); ?>" class="btn btn-info ml-2">
                <i class="mdi mdi-eye"></i> Ver detalhes
            </a>
        <?php endif; ?>
    </div>
</form>