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
    /* Reset e Fundo */
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

    .content-wrapper {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* Container do Login */
    .login-wrapper {
      display: flex;
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
      min-height: 600px;
    }

    /* Lado Esquerdo - Imagem */
    .login-image {
      flex: 1;
      background: linear-gradient(135deg, #ff6b35, #f7931e);
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
      min-height: 500px;
    }

    .login-image .food-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(255, 107, 53, 0.85);
      z-index: 1;
    }

    .login-image img.hero-food {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 0;
    }

    .login-image .hero-content {
      position: relative;
      z-index: 2;
      color: #fff;
      text-align: center;
      padding: 20px;
    }

    .login-image .hero-content .food-icon {
      font-size: 80px;
      margin-bottom: 20px;
      display: block;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
    }

    .login-image .hero-content h1 {
      font-size: 42px;
      font-weight: 700;
      margin-bottom: 15px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .login-image .hero-content p {
      font-size: 18px;
      opacity: 0.95;
      line-height: 1.6;
      max-width: 400px;
      margin: 0 auto;
    }

    .login-image .hero-features {
      position: relative;
      z-index: 2;
      display: flex;
      gap: 30px;
      margin-top: 30px;
      color: #fff;
    }

    .login-image .hero-features .feature-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 5px;
    }

    .login-image .hero-features .feature-item .mdi {
      font-size: 28px;
    }

    .login-image .hero-features .feature-item span {
      font-size: 13px;
      opacity: 0.9;
    }

    /* Lado Direito - Formulário */
    .login-form {
      flex: 1;
      padding: 50px 45px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: #fff;
      min-width: 380px;
    }

    .login-form .brand-logo {
      text-align: center;
      margin-bottom: 25px;
    }

    .login-form .brand-logo img {
      max-width: 160px;
    }

    .login-form .welcome-text {
      text-align: center;
      margin-bottom: 25px;
    }

    .login-form .welcome-text h4 {
      font-size: 24px;
      font-weight: 700;
      color: #2c2c2c;
      margin-bottom: 5px;
    }

    .login-form .welcome-text h6 {
      font-size: 15px;
      font-weight: 300;
      color: #6c757d;
      margin: 0;
    }

    .login-form .form-group label {
      font-weight: 500;
      font-size: 14px;
      color: #2c2c2c;
      margin-bottom: 6px;
    }

    .login-form .form-control {
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 14px;
      border: 1.5px solid #e9ecef;
      transition: all 0.3s ease;
      height: auto;
    }

    .login-form .form-control:focus {
      border-color: #ff6b35;
      box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
    }

    .login-form .input-group-text {
      background: #f8f9fa;
      border: 1.5px solid #e9ecef;
      border-right: none;
      border-radius: 10px 0 0 10px;
      color: #6c757d;
    }

    .login-form .input-group .form-control {
      border-radius: 0 10px 10px 0;
      border-left: none;
    }

    .login-form .btn-login {
      background: linear-gradient(135deg, #ff6b35, #f7931e);
      border: none;
      border-radius: 10px;
      padding: 14px;
      font-weight: 600;
      font-size: 16px;
      color: #fff;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(255, 107, 53, 0.35);
      width: 100%;
    }

    .login-form .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 25px rgba(255, 107, 53, 0.45);
    }

    .login-form .btn-login .mdi {
      font-size: 20px;
      margin-right: 8px;
    }

    .login-form .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 15px 0 20px;
    }

    .login-form .form-options .form-check-label {
      font-size: 14px;
      color: #6c757d;
    }

    .login-form .form-options .form-check-input {
      border-radius: 4px;
      border: 1.5px solid #ced4da;
    }

    .login-form .form-options .form-check-input:checked {
      background-color: #ff6b35;
      border-color: #ff6b35;
    }

    .login-form .auth-link {
      color: #ff6b35;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: color 0.3s;
    }

    .login-form .auth-link:hover {
      color: #e55a2b;
      text-decoration: underline;
    }

    .login-form .register-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #6c757d;
    }

    .login-form .register-link a {
      color: #ff6b35;
      font-weight: 600;
      text-decoration: none;
    }

    .login-form .register-link a:hover {
      text-decoration: underline;
    }

    /* Alerts */
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

    .alert-info {
      background: #d1ecf1;
      color: #0c5460;
    }

    .alert .close {
      outline: none;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .login-wrapper {
        flex-direction: column;
        border-radius: 16px;
      }

      .login-image {
        min-height: 250px;
        padding: 30px;
      }

      .login-image .hero-content h1 {
        font-size: 28px;
      }

      .login-image .hero-content p {
        font-size: 15px;
      }

      .login-image .hero-features {
        gap: 15px;
      }

      .login-form {
        padding: 30px 25px;
        min-width: unset;
      }

      .login-form .welcome-text h4 {
        font-size: 20px;
      }
    }

    @media (max-width: 576px) {
      .login-form {
        padding: 20px;
      }

      .login-image .hero-content .food-icon {
        font-size: 50px;
      }

      .login-image .hero-content h1 {
        font-size: 22px;
      }

      .login-image .hero-features .feature-item .mdi {
        font-size: 20px;
      }

      .login-image .hero-features .feature-item span {
        font-size: 11px;
      }

      .login-form .form-options {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
      }
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-12">
            <div class="login-wrapper">

              <!-- Lado Esquerdo - Imagem -->
              <div class="login-image">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=600&fit=crop&crop=center"
                  alt="Comida"
                  class="hero-food">
                <div class="food-overlay"></div>
                <div class="hero-content">
                  <span class="food-icon">🍕</span>
                  <h1>Food Delivery</h1>
                  <p>Os melhores sabores da cidade entregues na sua porta com rapidez e qualidade.</p>
                  <div class="hero-features">
                    <div class="feature-item">
                      <i class="mdi mdi-food"></i>
                      <span>Comida Fresca</span>
                    </div>
                    <div class="feature-item">
                      <i class="mdi mdi-clock-fast"></i>
                      <span>Entrega Rápida</span>
                    </div>
                    <div class="feature-item">
                      <i class="mdi mdi-star"></i>
                      <span>5 Estrelas</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Lado Direito - Formulário -->
              <div class="login-form">
                <div class="brand-logo">
                  <img src="<?php echo site_url('admin/'); ?>images/logo.svg" alt="Food Delivery">
                </div>

                <div class="welcome-text">
                  <h4>Bem-vindo de volta! 👋</h4>
                  <h6>Faça login para continuar pedindo</h6>
                </div>

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

                <?php if (session()->has('sucesso')): ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-circle"></i>
                    <strong>Sucesso!</strong> <?php echo session('sucesso'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php endif; ?>

                <form action="<?php echo site_url('login/autenticar'); ?>" method="POST">
                  <?php echo csrf_field(); ?>

                  <div class="form-group">
                    <label for="email"><i class="mdi mdi-email-outline"></i> E-mail</label>
                    <input type="email"
                      class="form-control form-control-lg"
                      id="email"
                      name="email"
                      placeholder="seu@email.com"
                      value="<?php echo old('email'); ?>"
                      required>
                  </div>

                  <div class="form-group">
                    <label for="password"><i class="mdi mdi-lock-outline"></i> Senha</label>
                    <input type="password"
                      class="form-control form-control-lg"
                      id="password"
                      name="password"
                      placeholder="••••••••"
                      required>
                  </div>

                  <div class="form-options">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="lembrar">
                        Lembrar-me
                      </label>
                    </div>
                    <a href="#" class="auth-link">Esqueceu a senha?</a>
                  </div>

                  <button type="submit" class="btn btn-login">
                    <i class="mdi mdi-login"></i> Entrar
                  </button>

                  <div class="register-link">
                    Não tem uma conta? <a href="#">Criar conta</a>
                  </div>
                </form>
              </div>

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
    // Fecha os alerts automaticamente após 5 segundos
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