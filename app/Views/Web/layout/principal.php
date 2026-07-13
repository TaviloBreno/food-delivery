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
</head>

<body>
    <?php echo $this->renderSection('conteudo'); ?>
    <?php echo $this->renderSection('scripts'); ?>
</body>

</html>