<?php echo $this->extend('Web/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo ?? 'Carrinho'; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/font-awesome.min.css'); ?>">
<style>
    body {
        background: #f7f7f7;
    }

    .carrinho-shell {
        max-width: 1100px;
        margin: 40px auto;
        padding: 24px;
    }

    .carrinho-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, .08);
        overflow: hidden;
    }

    .carrinho-header {
        background: linear-gradient(90deg, #ff6b35, #ff8c42);
        color: #fff;
        padding: 28px;
    }

    .carrinho-content {
        padding: 28px;
    }

    .item-row {
        border-bottom: 1px solid #eee;
        padding: 14px 0;
    }

    .price {
        color: #ff6b35;
        font-weight: 700;
    }

    .btn-checkout {
        background: #ff6b35;
        color: #fff;
        border-radius: 999px;
        padding: 10px 18px;
    }

    .btn-checkout:hover {
        background: #e45a24;
        color: #fff;
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="carrinho-shell">
    <div class="carrinho-card">
        <div class="carrinho-header">
            <h2 class="mb-1"><i class="fa fa-shopping-cart"></i> Seu carrinho</h2>
            <p class="mb-0">Revise seus itens antes de finalizar o pedido.</p>
        </div>
        <div class="carrinho-content">
            <?php if (!empty($itens)): ?>
                <form action="<?php echo site_url('carrinho/atualizar'); ?>" method="post">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($itens as $id => $item): ?>
                                    <tr class="item-row">
                                        <td><strong><?php echo esc($item['nome']); ?></strong></td>
                                        <td class="unit-price">R$ <?php echo number_format((float) ($item['preco'] ?? 0), 2, ',', '.'); ?></td>
                                        <td>
                                            <input type="number" name="quantidades[<?php echo $id; ?>]" class="form-control quantity-input" value="<?php echo (int) ($item['quantidade'] ?? 1); ?>" min="1" style="max-width: 90px;" data-price="<?php echo (float) ($item['preco'] ?? 0); ?>" data-item-id="<?php echo $id; ?>">
                                        </td>
                                        <td class="price item-total" data-item-id="<?php echo $id; ?>">R$ <?php echo number_format(((float) ($item['preco'] ?? 0)) * ((int) ($item['quantidade'] ?? 1)), 2, ',', '.'); ?></td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Atualizar</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('remover-<?php echo $id; ?>').submit();">Remover</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <?php foreach ($itens as $id => $item): ?>
                    <form id="remover-<?php echo $id; ?>" action="<?php echo site_url('carrinho/remover'); ?>" method="post" style="display:none;">
                        <input type="hidden" name="produto_id" value="<?php echo $id; ?>">
                    </form>
                <?php endforeach; ?>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h4>Total do carrinho</h4>
                        <p class="lead" id="cart-total">R$ <?php echo number_format((float) $total, 2, ',', '.'); ?></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?php echo site_url('checkout'); ?>" class="btn btn-checkout"><i class="fa fa-credit-card"></i> Finalizar pedido</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <h4>Seu carrinho está vazio.</h4>
                    <p class="text-muted">Adicione produtos para começar seu pedido.</p>
                    <a href="<?php echo site_url('/'); ?>" class="btn btn-checkout">Voltar ao cardápio</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const cartTotal = document.getElementById('cart-total');

        const formatCurrency = function(value) {
            return 'R$ ' + value.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        };

        const updateTotals = function() {
            let total = 0;

            quantityInputs.forEach(function(input) {
                const quantity = Math.max(1, parseInt(input.value, 10) || 1);
                const price = parseFloat(input.dataset.price || 0);
                const itemTotal = quantity * price;
                total += itemTotal;

                const itemTotalCell = document.querySelector('.item-total[data-item-id="' + input.dataset.itemId + '"]');
                if (itemTotalCell) {
                    itemTotalCell.textContent = formatCurrency(itemTotal);
                }
            });

            if (cartTotal) {
                cartTotal.textContent = formatCurrency(total);
            }
        };

        quantityInputs.forEach(function(input) {
            input.addEventListener('input', updateTotals);
            input.addEventListener('change', updateTotals);
        });

        updateTotals();
    });
</script>
<?php echo $this->endSection(); ?>