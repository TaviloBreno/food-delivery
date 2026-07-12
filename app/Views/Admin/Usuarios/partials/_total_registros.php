<?php

/**
 * Partial: Total de registros
 * 
 * @var int $total Total de registros
 * @var string $label Label opcional
 */
?>

<div class="d-flex justify-content-between align-items-center mt-2 mb-2">
    <span class="text-muted" style="font-size: 13px;">
        <?php echo $label ?? 'Total'; ?>: <strong><?php echo $total ?? 0; ?></strong>
    </span>
</div>