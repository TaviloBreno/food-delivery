<?php

/**
 * Partial: Mensagens de feedback
 * 
 * @var string $tipo   Tipo da mensagem (sucesso, erro, atencao, info)
 * @var string $titulo Título da mensagem (opcional)
 * @var string $texto  Texto da mensagem
 */
?>

<div class="alert alert-<?php echo $tipo; ?> alert-dismissible fade show" role="alert">
    <strong><?php echo $titulo ?? ucfirst($tipo); ?>!</strong>
    <?php echo $texto; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>