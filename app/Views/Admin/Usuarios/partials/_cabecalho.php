<?php

/**
 * Partial: Cabeçalho da página
 * 
 * @var string $titulo      Título da página
 * @var string $subtitulo   Subtítulo da página (opcional)
 * @var string $botao_texto Texto do botão (opcional)
 * @var string $botao_url   URL do botão (opcional)
 * @var string $botao_icone Ícone do botão (opcional)
 */
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="card-title mb-0"><?php echo $titulo; ?></h4>
        <?php if (!empty($subtitulo)): ?>
            <p class="card-description text-muted" style="font-size: 13px; margin-top: 4px;">
                <?php echo $subtitulo; ?>
            </p>
        <?php endif; ?>
    </div>

    <?php if (!empty($botao_texto) && !empty($botao_url)): ?>
        <a href="<?php echo $botao_url; ?>" class="btn btn-success btn-sm">
            <i class="mdi <?php echo $botao_icone ?? 'mdi-plus'; ?>"></i>
            <?php echo $botao_texto; ?>
        </a>
    <?php endif; ?>
</div>