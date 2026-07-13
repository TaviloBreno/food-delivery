<?php echo $this->extend('Web/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo ?? 'Food Delivery'; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/bootstrap-theme.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/fonts.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/slick.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/slick-theme.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/aos.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/scrolling-nav.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/bootstrap-datepicker.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/bootstrap-datetimepicker.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/touch-sideswipe.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/jquery.fancybox.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/main.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/responsive.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/css/delivery-custom.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<!-- BEGIN body-wrapper -->
<div class="body-wrapper">

    <!-- HEADER -->
    <header id="header">

        <!-- CAROUSEL -->
        <div id="main-carousel" class="carousel slide" data-ride="carousel">
            <div class="container pos_rel">
                <ol class="carousel-indicators">
                    <?php if (!empty($destaques)): ?>
                        <?php foreach ($destaques as $key => $item): ?>
                            <li data-target="#main-carousel" data-slide-to="<?php echo $key; ?>" class="<?php echo $key === 0 ? 'active' : ''; ?>"></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
                    <?php endif; ?>
                </ol>

                <a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>

                <div class="carousel-inner" role="listbox">
                    <?php if (!empty($destaques)): ?>
                        <?php foreach ($destaques as $key => $item): ?>
                            <div class="item <?php echo $key === 0 ? 'active' : ''; ?>">
                                <div class="carousel-caption">
                                    <div class="fadeUp item_img">
                                        <img src="<?php echo base_url('web/src/assets/img/photos/' . ($item->imagem ?? 'pizza.png')); ?>" alt="<?php echo esc($item->nome ?? 'Produto'); ?>" />
                                        <?php if (isset($item->desconto) && $item->desconto > 0): ?>
                                            <div class="item_badge">
                                                <span class="badge_btext"><?php echo $item->desconto; ?>%</span>
                                                <span class="badge_stext">OFF</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="fadeUp fade-slow item_details">
                                        <h4 class="item_name"><?php echo esc($item->nome ?? 'Delicious Food'); ?></h4>
                                        <p class="item_info"><?php echo esc($item->descricao_curta ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'); ?></p>
                                        <div class="item_link_box">
                                            <a href="#menu" class="item_link page-scroll">Ver Cardápio</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="item active">
                            <div class="carousel-caption">
                                <div class="fadeUp item_img">
                                    <img src="<?php echo base_url('web/src/assets/img/photos/pizza.png'); ?>" alt="Pizza" />
                                    <div class="item_badge">
                                        <span class="badge_btext">20%</span>
                                        <span class="badge_stext">OFF</span>
                                    </div>
                                </div>
                                <div class="fadeUp fade-slow item_details">
                                    <h4 class="item_name">Bem-vindo ao Food Delivery</h4>
                                    <p class="item_info">Os melhores pratos preparados com ingredientes frescos e selecionados.</p>
                                    <div class="item_link_box">
                                        <a href="#menu" class="item_link page-scroll">Ver Cardápio</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- NAVIGATION -->
        <div class="navigation">
            <div class="navbar-container" data-spy="affix" data-offset-top="400">
                <div class="container">
                    <div class="navbar_top hidden-xs">
                        <div class="top_addr">
                            <span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc($configuracao->cidade ?? 'Sua Cidade'); ?>, <?php echo esc($configuracao->endereco ?? 'Seu Endereço'); ?></span>
                            <span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc($configuracao->telefone ?? '(00) 0000-0000'); ?></span>
                            <span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo esc($configuracao->horarioFuncionamento ?? '11:00 - 23:00'); ?></span>
                            <div class="pull-right search-block">
                                <i class="fa fa-search" id="search" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div id="navbar_search">
                            <form method="get" action="<?php echo base_url('busca'); ?>">
                                <input type="text" name="q" class="form-control pull-left" value="" placeholder="Buscar produtos...">
                                <button type="submit" class="pull-right close" id="search_close"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div>

                    <nav class="navbar">
                        <div id="navbar_content">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url('web/src/assets/img/logo.png'); ?>" alt="Food Delivery" />
                                </a>
                                <a href="#cd-nav" class="cd-nav-trigger right_menu_icon">
                                    <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                                </a>
                            </div>

                            <div class="collapse navbar-collapse" id="navbar">
                                <div class="navbar-right">
                                    <ul class="nav navbar-nav">
                                        <li><a class="page-scroll" href="#header">Home</a></li>
                                        <li><a class="page-scroll" href="#about_us">Sobre</a></li>
                                        <li><a class="page-scroll" href="#menu">Cardápio</a></li>
                                        <li><a class="page-scroll" href="#gallery">Galeria</a></li>
                                        <li><a class="page-scroll" href="#reservation">Reserva</a></li>
                                        <li><a class="page-scroll" href="#footer">Contato</a></li>
                                        <?php if ($isLoggedIn ?? false): ?>
                                            <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Painel</a></li>
                                            <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out"></i> Sair</a></li>
                                        <?php else: ?>
                                            <li><a href="<?php echo base_url('login'); ?>"><i class="fa fa-user"></i> Entrar</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- DASHBOARD STATS -->
    <div class="container section" style="padding: 40px 0;">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="section-title title_sty1 text-center">📊 Dashboard do Sistema</h2>
                <p class="short">Bem-vindo, <?php echo esc($usuario_nome ?? 'Visitante'); ?>! Gerencie seu delivery com facilidade.</p>
            </div>
        </div>

        <div class="row">
            <?php
            $cards = [
                ['class' => 'primary', 'icon' => 'users', 'number' => $totalUsuarios ?? 0, 'label' => 'Total de Usuários', 'change' => ($totalUsuariosAtivos ?? 0) . ' ativos'],
                ['class' => 'success', 'icon' => 'cutlery', 'number' => $totalProdutos ?? 0, 'label' => 'Total de Produtos', 'change' => ($totalProdutosDestaque ?? 0) . ' em destaque'],
                ['class' => 'warning', 'icon' => 'motorcycle', 'number' => $totalEntregadores ?? 0, 'label' => 'Total de Entregadores', 'change' => ($totalEntregadoresDisponiveis ?? 0) . ' disponíveis'],
                ['class' => 'info', 'icon' => 'map-marker', 'number' => $totalBairros ?? 0, 'label' => 'Bairros Atendidos', 'change' => ($totalBairrosAtivos ?? 0) . ' ativos'],
                ['class' => 'danger', 'icon' => 'user-times', 'number' => $totalUsuariosInativos ?? 0, 'label' => 'Usuários Inativos', 'change' => ($totalUsuariosDeletados ?? 0) . ' excluídos'],
                ['class' => 'pink', 'icon' => 'folder-open', 'number' => $totalCategorias ?? 0, 'label' => 'Total de Categorias', 'change' => ($totalCategoriasAtivas ?? 0) . ' ativas'],
                ['class' => 'orange', 'icon' => 'credit-card', 'number' => $totalFormasPagamento ?? 0, 'label' => 'Formas de Pagamento', 'change' => ($totalFormasPagamentoAtivas ?? 0) . ' ativas'],
                ['class' => 'purple', 'icon' => 'package', 'number' => $totalProdutosInativos ?? 0, 'label' => 'Produtos Inativos', 'change' => 'Aguardando ativação']
            ];
            ?>
            <?php foreach ($cards as $card): ?>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="stat-card stat-<?php echo $card['class']; ?>">
                        <div class="stat-icon"><i class="fa fa-<?php echo $card['icon']; ?>"></i></div>
                        <div class="stat-number"><?php echo $card['number']; ?></div>
                        <div class="stat-label"><?php echo $card['label']; ?></div>
                        <div class="stat-change">
                            <i class="fa fa-check-circle"></i> <?php echo $card['change']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ABOUT US -->
    <div class="container section" id="about_us">
        <div class="col-sm-12 d-flex flex-xs-column">
            <div class="col-sm-6 d-flex align-items-center padd_lr0" data-aos="fade-up">
                <div class="content">
                    <h1 class="section-title title_sty1">Sobre Nós</h1>
                    <p class="short"><?php echo esc($configuracao->sobre ?? 'Bem-vindo ao Food Delivery! Oferecemos os melhores pratos preparados com ingredientes frescos e selecionados.'); ?></p>
                    <p class="short"><?php echo esc($configuracao->sobreExtra ?? 'Trabalhamos com os melhores chefs e ingredientes para garantir qualidade e sabor em cada pedido.'); ?></p>
                </div>
            </div>
            <div class="col-sm-6 img text-center padd_lr0" data-aos="fade-down">
                <div class="border_on">
                    <img src="<?php echo base_url('web/src/assets/img/photos/about-us.jpg'); ?>" alt="Sobre nós" class="about_img" />
                </div>
            </div>
        </div>
    </div>

    <!-- MENU -->
    <div class="container section" id="menu" data-aos="fade-up">
        <div class="title-block text-center">
            <h1 class="section-title title_sty1">Nosso Cardápio</h1>
        </div>

        <div class="menu_filter text-center">
            <ul class="list-unstyled list-inline d-inline-block" id="menuFilter">
                <li class="item active">
                    <a href="javascript:;" class="filter-button" data-filter="all">Todos</a>
                </li>
                <?php if (!empty($categoriasMenu)): ?>
                    <?php foreach ($categoriasMenu as $categoria): ?>
                        <li class="item">
                            <a href="javascript:;" class="filter-button" data-filter="<?php echo $categoria->slug; ?>">
                                <?php echo esc($categoria->nome); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>

        <div id="menu_items">
            <?php if (!empty($categoriasMenu) && !empty($produtosPorCategoria)): ?>
                <?php foreach ($categoriasMenu as $categoria): ?>
                    <div class="filtr-item image filter <?php echo $categoria->slug; ?>">
                        <div class="row">
                            <?php
                            $produtos = $produtosPorCategoria[$categoria->id] ?? [];
                            foreach ($produtos as $produto):
                            ?>
                                <div class="col-sm-6 col-md-4">
                                    <a href="<?php echo base_url('produto/' . $produto->slug); ?>" class="block fancybox" data-fancybox-group="fancybox">
                                        <div class="content">
                                            <div class="filter_item_img">
                                                <i class="fa fa-search-plus"></i>
                                                <img src="<?php echo base_url('web/src/assets/img/photos/' . ($produto->imagem ?? 'food-1.jpg')); ?>" alt="<?php echo esc($produto->nome); ?>" />
                                            </div>
                                            <div class="info text-center">
                                                <div class="name"><?php echo esc($produto->nome); ?></div>
                                                <div class="short"><?php echo esc($produto->descricao_curta ?? ''); ?></div>
                                                <span class="filter_item_price">R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?></span>
                                                <?php if ($produto->destaque): ?>
                                                    <span class="badge badge-warning" style="margin-left: 10px;">Destaque</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center">
                    <p class="alert alert-info">Nenhum produto encontrado no momento.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- RESERVATION -->
    <div class="fixed_layer section" id="reservation">
        <div class="fixed_layer_padd container">
            <div class="row">
                <div class="col-md-offset-6 col-md-6" data-aos="fade-down">
                    <div class="reserv_box">
                        <h1 class="section-title title_sty1">Reserva Online</h1>
                        <p class="short">Faça sua reserva e garanta uma mesa em nosso restaurante.</p>
                        <form id="reserv_form" method="post" action="<?php echo base_url('reserva/salvar'); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form_pos">
                                        <input type="text" name="nome" required="" placeholder="Seu nome" class="form-control" />
                                        <span class="form_icon"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form_pos">
                                        <input type="email" name="email" required="" placeholder="Seu email" class="form-control" />
                                        <span class="form_icon"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group form_pos">
                                        <input type="text" name="telefone" required="" placeholder="Telefone" class="form-control" />
                                        <span class="form_icon"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form_pos">
                                        <input type="text" name="data" required="" placeholder="Data" class="form-control" id="reserv_date" />
                                        <span class="form_icon"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form_pos">
                                        <input type="text" name="hora" required="" placeholder="Hora" class="form-control" id="reserv_time" />
                                        <span class="form_icon"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form_pos">
                                        <input type="number" name="pessoas" required="" placeholder="Número de pessoas" class="form-control" min="1" max="20" />
                                        <span class="form_icon"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea rows="3" name="mensagem" placeholder="Mensagem (opcional)" class="form-control"></textarea>
                            </div>
                            <input type="submit" name="send" value="Reservar Agora" class="btn btn-block" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GALLERY -->
    <div class="container section" id="gallery" data-aos="fade-up">
        <div class="title-block text-center">
            <h1 class="section-title title_sty1">Galeria</h1>
        </div>
        <div id="photo_gallery" class="list1">
            <div class="row loadMore">
                <?php if (!empty($galeria)): ?>
                    <?php foreach ($galeria as $foto): ?>
                        <div class="col-sm-4 col-md-3 item">
                            <a href="<?php echo base_url('web/src/assets/img/photos/' . $foto); ?>" class="block fancybox" data-fancybox-group="fancybox">
                                <div class="content">
                                    <img src="<?php echo base_url('web/src/assets/img/photos/' . $foto); ?>" alt="Galeria" />
                                    <div class="zoom">
                                        <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="alert alert-info">Nenhuma foto na galeria.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer id="footer">
        <div class="section" id="contact">
            <div id="googleMap"></div>
            <div class="footer_pos">
                <div class="container">
                    <div class="footer_content">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <h4 class="footer_ttl footer_ttl_padd">Sobre Nós</h4>
                                <p class="footer_txt"><?php echo esc($configuracao->sobreFooter ?? 'Food Delivery - Entregamos sabor e qualidade diretamente na sua casa.'); ?></p>
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <h4 class="footer_ttl footer_ttl_padd">Horário de Funcionamento</h4>
                                <div class="footer_border">
                                    <?php if (!empty($horariosFuncionamento)): ?>
                                        <?php foreach ($horariosFuncionamento as $dia => $horario): ?>
                                            <div class="week_row clearfix">
                                                <div class="week_day"><?php echo $dia; ?></div>
                                                <div class="week_time text-right">
                                                    <?php if ($horario['fechado'] ?? false): ?>
                                                        Fechado
                                                    <?php else: ?>
                                                        <span class="week_time_start"><?php echo $horario['abertura'] ?? '--:--'; ?></span>
                                                        <span class="week_time_node">-</span>
                                                        <span class="week_time_end"><?php echo $horario['fechamento'] ?? '--:--'; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-muted">Horários não disponíveis</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <h4 class="footer_ttl footer_ttl_padd">Contato</h4>
                                <div class="footer_border">
                                    <div class="footer_cnt">
                                        <i class="fa fa-map-marker"></i>
                                        <span><?php echo esc($configuracao->enderecoCompleto ?? 'Seu endereço aqui'); ?></span>
                                    </div>
                                    <div class="footer_cnt">
                                        <i class="fa fa-phone"></i>
                                        <span><?php echo esc($configuracao->telefone ?? '(00) 0000-0000'); ?></span>
                                    </div>
                                    <div class="footer_cnt">
                                        <i class="fa fa-envelope"></i>
                                        <span><?php echo esc($configuracao->email ?? 'contato@fooddelivery.com'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="copy_text">
                                    &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>">Food Delivery</a> - Todos os direitos reservados.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="social-links">
                                    <ul class="list-inline">
                                        <?php if (!empty($redesSociais)): ?>
                                            <?php foreach ($redesSociais as $rede): ?>
                                                <li class="list-inline-item">
                                                    <a href="<?php echo $rede['url'] ?? '#'; ?>" target="_blank" title="<?php echo $rede['nome'] ?? ''; ?>">
                                                        <i class="fa fa-<?php echo $rede['icone'] ?? 'globe'; ?>" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li class="list-inline-item">
                                                <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" title="Instagram"><i class="fa fa-instagram"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- MOBILE MENU -->
    <nav class="cd-nav-container right_menu" id="cd-nav">
        <div class="header__open_menu">
            <a href="<?php echo base_url(); ?>" class="rmenu_logo">
                <img src="<?php echo base_url('web/src/assets/img/logo.png'); ?>" alt="logo" />
            </a>
        </div>
        <div class="right_menu_search">
            <form method="get" action="<?php echo base_url('busca'); ?>">
                <input type="text" name="q" class="form-control search_input" value="" placeholder="Buscar...">
                <button type="submit" class="search_icon"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <ul class="rmenu_list">
            <li><a class="page-scroll" href="#header">Home</a></li>
            <li><a class="page-scroll" href="#about_us">Sobre</a></li>
            <li><a class="page-scroll" href="#menu">Cardápio</a></li>
            <li><a class="page-scroll" href="#gallery">Galeria</a></li>
            <li><a class="page-scroll" href="#reservation">Reserva</a></li>
            <li><a class="page-scroll" href="#footer">Contato</a></li>
        </ul>
        <div class="right_menu_addr top_addr">
            <span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc($configuracao->cidade ?? 'Sua Cidade'); ?></span>
            <span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc($configuracao->telefone ?? '(00) 0000-0000'); ?></span>
            <span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo esc($configuracao->horarioFuncionamento ?? '11:00 - 23:00'); ?></span>
        </div>
    </nav>
    <div class="cd-overlay"></div>

</div>
<!-- END body-wrapper -->

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script src="<?php echo base_url('web/src/assets/js/jquery-2.1.1.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/jquery.mousewheel.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/jquery.easing.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/scrolling-nav.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/aos.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/slick.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/jquery.touchSwipe.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/moment.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/bootstrap-datetimepicker.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/jquery.fancybox.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/loadMoreResults.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/main.js'); ?>"></script>
<script src="<?php echo base_url('web/js/delivery-custom.js'); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $configuracao->googleMapsApiKey ?? 'AIzaSyBcg5Y2D1fpGI12T8wcbtPIsyGdw-_NV1Y'; ?>&amp;callback=myMap"></script>
<?php echo $this->endSection(); ?>