<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Food Delivery | <?php echo $titulo; ?></title>

    <link rel="stylesheet" href="<?php echo site_url('admin/'); ?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo site_url('admin/'); ?>vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo site_url('admin/'); ?>css/style.css">
    <link rel="shortcut icon" href="<?php echo site_url('admin/'); ?>images/favicon.png" />

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .full-page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-form-light {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo img {
            max-width: 160px;
        }

        .auth-form-light h4 {
            text-align: center;
            font-weight: 700;
            color: #2c2c2c;
            margin-bottom: 5px;
        }

        .auth-form-light h6 {
            text-align: center;
            font-weight: 300;
            color: #6c757d;
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 500;
            font-size: 14px;
            color: #2c2c2c;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            border: 1.5px solid #e9ecef;
            transition: all 0.3s ease;
            height: auto;
        }

        .form-control:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            color: #fff;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(255, 107, 53, 0.45);
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
        }

        .password-requirements {
            font-size: 12px;
            color: #6c757d;
            margin-top: 5px;
        }

        .password-requirements .mdi {
            font-size: 14px;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #ff6b35;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-12">
                        <div class="auth-form-light text-left">
                            <div class="brand-logo">
                                <img src="<?php echo site_url('admin/'); ?>images/logo.svg" alt="Food Delivery">
                            </div>
                            <h4>Redefinir senha 🔐</h4>
                            <h6>Digite sua nova senha abaixo</h6>

                            <?php if (session()->has('erro')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-circle"></i>
                                    <strong>Erro!</strong> <?php echo session('erro'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->has('atencao')): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert"></i>
                                    <strong>Atenção!</strong> <?php echo session('atencao'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <form action="<?php echo site_url('login/salvar-nova-senha'); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="token" value="<?php echo $token; ?>">

                                <div class="form-group">
                                    <label for="senha"><i class="mdi mdi-lock-outline"></i> Nova senha</label>
                                    <input type="password"
                                        class="form-control form-control-lg"
                                        id="senha"
                                        name="senha"
                                        placeholder="Digite sua nova senha"
                                        required>
                                    <div class="password-requirements">
                                        <span><i class="mdi mdi-check-circle-outline"></i> Mínimo 8 caracteres</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="senha_confirmacao"><i class="mdi mdi-lock-outline"></i> Confirmar senha</label>
                                    <input type="password"
                                        class="form-control form-control-lg"
                                        id="senha_confirmacao"
                                        name="senha_confirmacao"
                                        placeholder="Confirme sua nova senha"
                                        required>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-check"></i> Redefinir senha
                                </button>

                                <div class="back-link">
                                    <a href="<?php echo site_url('login/novo'); ?>"><i class="mdi mdi-arrow-left"></i> Voltar para o login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo site_url('admin/'); ?>vendors/base/vendor.bundle.base.js"></script>
    <script src="<?php echo site_url('admin/'); ?>js/off-canvas.js"></script>
    <script src="<?php echo site_url('admin/'); ?>js/hoverable-collapse.js"></script>
    <script src="<?php echo site_url('admin/'); ?>js/template.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var senha = document.getElementById('senha');
            var confirmacao = document.getElementById('senha_confirmacao');

            confirmacao.addEventListener('keyup', function() {
                if (senha.value.length > 0 && confirmacao.value.length > 0) {
                    if (senha.value === confirmacao.value) {
                        confirmacao.style.borderColor = '#28a745';
                    } else {
                        confirmacao.style.borderColor = '#dc3545';
                    }
                } else {
                    confirmacao.style.borderColor = '';
                }
            });
        });

        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            });
        }, 5000);
    </script>
</body>

</html>