<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Food Delivery | <?php echo $this->renderSection('titulo'); ?></title>

  <!-- 🔥 CSS COM VERSÃO AUTOMÁTICA -->
  <link rel="stylesheet" href="<?php echo asset_version('admin/vendors/mdi/css/materialdesignicons.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset_version('admin/vendors/base/vendor.bundle.base.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset_version('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset_version('admin/css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset_version('admin/css/alertas.css'); ?>">
  <link rel="shortcut icon" href="<?php echo site_url('admin/'); ?>images/favicon.png" />
  <link rel="stylesheet" href="<?php echo asset_version('admin/css/usuarios.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset_version('admin/css/categorias.css'); ?>">

  <?php echo $this->renderSection('estilos'); ?>
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" href="index.html"><img src="<?php echo site_url('admin/'); ?>images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?php echo site_url('admin/'); ?>images/logo-mini.svg" alt="logo" /></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-message-text mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">David Grey</h6>
                  <p class="font-weight-light small-text text-muted mb-0">The meeting is cancelled</p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Tim Cook</h6>
                  <p class="font-weight-light small-text text-muted mb-0">New product launch</p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Johnson</h6>
                  <p class="font-weight-light small-text text-muted mb-0">Upcoming board meeting</p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown mr-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">Just now</p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="mdi mdi-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">Private message</p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="mdi mdi-account-box mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">2 days ago</p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?php echo site_url('admin/images/faces/face5.jpg'); ?>" alt="profile" />
              <span class="nav-profile-name">
                <?php echo session('usuario_nome') ?? 'Usuário'; ?>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="<?php echo site_url('admin/usuarios/editar/' . session('usuario_id')); ?>">
                <i class="mdi mdi-account text-primary"></i> Meu Perfil
              </a>
              <a class="dropdown-item" href="<?php echo site_url('admin/usuarios'); ?>">
                <i class="mdi mdi-account-multiple text-primary"></i> Usuários
              </a>
              <a class="dropdown-item" href="<?php echo site_url('admin/categorias'); ?>">
                <i class="mdi mdi-folder-menu text-primary"></i> Categorias
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">
                <i class="mdi mdi-logout text-danger"></i> Sair
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>

    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('admin/usuarios'); ?>">
              <i class="mdi mdi-view-dashboard menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('admin/usuarios'); ?>">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Usuários</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('admin/categorias'); ?>">
              <i class="mdi mdi-folder-outline menu-icon"></i>
              <span class="menu-title">Categorias</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('login/logout'); ?>">
              <i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title">Sair</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="main-panel">
        <div class="content-wrapper">
          <?php if (session()->has('sucesso')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Perfeito!</strong> <?php echo session('sucesso'); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>

          <?php if (session()->has('info')): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <strong>Informação!</strong> <?php echo session('info'); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>

          <?php if (session()->has('atencao')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Atenção!</strong> <?php echo session('atencao'); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>

          <?php if (session()->has('erro')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Erro!</strong> <?php echo session('erro'); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>

          <?php echo $this->renderSection('conteudo'); ?>
        </div>

        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard template</a> from Bootstrapdash.com</span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <!-- 🔥 JS COM VERSÃO AUTOMÁTICA -->
  <script src="<?php echo asset_version('admin/vendors/base/vendor.bundle.base.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/vendors/chart.js/Chart.min.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/vendors/datatables.net/jquery.dataTables.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/js/off-canvas.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/js/hoverable-collapse.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/js/template.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/js/dashboard.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/js/data-table.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/js/jquery.dataTables.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/js/dataTables.bootstrap4.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/js/jquery.cookie.js'); ?>"></script>
  <script src="<?php echo asset_version('admin/js/alertas.js'); ?>"></script>

  <?php echo $this->renderSection('scripts'); ?>
</body>

</html>