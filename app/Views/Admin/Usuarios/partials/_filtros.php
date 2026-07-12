<?php

/**
 * Partial: Filtros de busca
 * 
 * @var string $placeholder Texto do placeholder (opcional)
 * @var string $input_id    ID do input (opcional)
 * @var array  $filtros     Filtros adicionais (opcional)
 */
?>

<div class="row mb-3">
    <div class="col-md-8">
        <div class="ui-widget">
            <input
                id="<?php echo $input_id ?? 'query'; ?>"
                name="query"
                placeholder="<?php echo $placeholder ?? 'Pesquise...'; ?>"
                class="form-control bg-light"
                autocomplete="off">
        </div>
    </div>

    <?php if (!empty($filtros)): ?>
        <div class="col-md-4">
            <div class="d-flex gap-2">
                <?php foreach ($filtros as $filtro): ?>
                    <select class="form-control form-control-sm" style="width: auto;">
                        <option value=""><?php echo $filtro['label']; ?></option>
                        <?php foreach ($filtro['opcoes'] as $opcao): ?>
                            <option value="<?php echo $opcao['valor']; ?>">
                                <?php echo $opcao['label']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>