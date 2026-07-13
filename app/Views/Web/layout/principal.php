<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->renderSection('titulo'); ?> - Food Delivery</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url('web/src/assets/img/favicon/favicon-32x32.png'); ?>">

    <?php echo $this->renderSection('estilos'); ?>
    <style>
        .nav-cart-link a {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .cart-badge,
        .floating-cart-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 22px;
            height: 22px;
            padding: 0 6px;
            border-radius: 999px;
            background: #ff6b35;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
        }

        .floating-cart-btn {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 9999;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b35, #ff8c42);
            color: #fff;
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.35);
            text-decoration: none;
        }

        .floating-cart-btn:hover {
            color: #fff;
            transform: translateY(-2px);
        }

        .floating-cart-btn .fa-shopping-cart {
            font-size: 24px;
        }

        .floating-cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
        }
    </style>
</head>

<body>
    <?php
    $itensCarrinho = session('carrinho') ?? [];
    $quantidadeTotalItens = 0;
    foreach ($itensCarrinho as $item) {
        $quantidadeTotalItens += (int) ($item['quantidade'] ?? 1);
    }
    $textoBadgeCarrinho = $quantidadeTotalItens > 9 ? '9+' : (string) $quantidadeTotalItens;
    ?>
    <?php echo $this->renderSection('conteudo'); ?>
    <a href="<?php echo site_url('carrinho'); ?>" class="floating-cart-btn" aria-label="Ir para o carrinho">
        <i class="fa fa-shopping-cart"></i>
        <?php if ($quantidadeTotalItens > 0): ?>
            <span class="floating-cart-badge"><?php echo esc($textoBadgeCarrinho); ?></span>
        <?php endif; ?>
    </a>
    <?php echo $this->renderSection('scripts'); ?>
</body>

</html>