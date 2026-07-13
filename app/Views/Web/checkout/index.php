<?php echo $this->extend('Web/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo ?? 'Checkout'; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/font-awesome.min.css'); ?>">
<style>
    body {
        background: linear-gradient(135deg, #fff7ed, #ffffff);
        color: #2f2f2f;
    }

    .checkout-shell {
        max-width: 1100px;
        margin: 40px auto;
        padding: 24px;
    }

    .checkout-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, .08);
        overflow: hidden;
    }

    .checkout-header {
        background: linear-gradient(90deg, #ff6b35, #ff8c42);
        color: #fff;
        padding: 32px 28px;
    }

    .checkout-content {
        padding: 28px;
    }

    .summary-box {
        background: #fff8f3;
        border: 1px solid #ffe2cc;
        border-radius: 14px;
        padding: 18px;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn-pay {
        background: #ff6b35;
        border: none;
        color: #fff;
        padding: 12px 20px;
        border-radius: 999px;
    }

    .btn-pay:hover {
        background: #e45a24;
        color: #fff;
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="checkout-shell">
    <div class="checkout-card">
        <div class="checkout-header">
            <h2 class="mb-1"><i class="fa fa-shopping-bag"></i> Finalizar pedido</h2>
            <p class="mb-0">Preencha os dados para concluir o seu pedido com rapidez e segurança.</p>
        </div>
        <div class="checkout-content">
            <div class="row">
                <div class="col-lg-7">
                    <h4 class="mb-3">Dados de entrega</h4>
                    <form action="<?php echo site_url('checkout/finalizar'); ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nome" placeholder="Seu nome" value="<?php echo esc($usuario_nome); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Telefone</label>
                                <input type="text" class="form-control" name="telefone" placeholder="(88) 99999-9999" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Endereço</label>
                            <input type="text" class="form-control" name="endereco" placeholder="Rua, número, complemento" required>
                        </div>
                        <div class="form-group">
                            <label>Observações</label>
                            <textarea class="form-control" name="observacoes" rows="4" placeholder="Alguma observação para o entregador?"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Forma de pagamento</label>
                            <select class="form-control" name="pagamento" required>
                                <option value="">Selecione</option>
                                <option value="Cartão de crédito">Cartão de crédito</option>
                                <option value="Pix">Pix</option>
                                <option value="Dinheiro">Dinheiro</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-pay"><i class="fa fa-check"></i> Confirmar pedido</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="summary-box">
                        <h4 class="mb-3">Resumo do pedido</h4>
                        <?php foreach ($itens as $item): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo esc($item['nome']); ?> × <?php echo (int) ($item['quantidade'] ?? 1); ?></span>
                                <strong>R$ <?php echo number_format(((float) ($item['preco'] ?? 0)) * ((int) ($item['quantidade'] ?? 1)), 2, ',', '.'); ?></strong>
                            </div>
                        <?php endforeach; ?>
                        <hr>
                        <div class="d-flex justify-content-between mb-3"><strong>Total</strong><strong>R$ <?php echo number_format((float) $total, 2, ',', '.'); ?></strong></div>
                        <p class="text-muted mb-0">Entrega estimada em 35-45 minutos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>