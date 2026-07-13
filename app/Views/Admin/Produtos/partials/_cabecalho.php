<?php

/**
 * Partial: Cabeçalho da página
 */
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="card-title mb-0"><?php echo $titulo; ?></h4>
    <?php if (!empty($botao_texto) && !empty($botao_url)): ?>
        <a href="<?php echo $botao_url; ?>" class="btn btn-success btn-sm">
            <i class="mdi mdi-plus"></i> <?php echo $botao_texto; ?>
        </a>
    <?php endif; ?>
</div>