<?php echo $this->extend('Web/layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo ?? 'Food Delivery'; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<!-- CSS do Template - Caminhos corrigidos -->
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
<!-- CSS Personalizado -->
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/delivery-custom.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('web/src/assets/css/home.css'); ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<!-- ============================================
     BODY WRAPPER
     ============================================ -->
<div class="body-wrapper">

    <!-- ============================================
         NAVBAR
         ============================================ -->
    <nav class="navbar navbar-custom navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url('web/src/assets/img/logo.png'); ?>" alt="Food Delivery">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#home">Home</a></li>
                    <li><a href="#about">Sobre</a></li>
                    <li><a href="#menu">Cardápio</a></li>
                    <li><a href="#contact">Contato</a></li>
                    <?php if ($isLoggedIn ?? false): ?>
                        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Painel</a></li>
                        <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out"></i> Sair</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo base_url('login'); ?>"><i class="fa fa-user"></i> Entrar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ============================================
         HERO SLIDER
         ============================================ -->
    <section id="home" class="hero-slider">
        <?php
        $slides = [
            [
                'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=1600&q=80',
                'image_food' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=700&q=80',
                'badge' => '20% OFF',
                'title' => 'Pizza <span>Margherita</span>',
                'description' => 'A verdadeira pizza italiana com molho de tomate fresco, muçarela de búfala e manjericão.',
                'button_text' => 'Ver Cardápio',
                'button_link' => '#menu'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=1600&q=80',
                'image_food' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=700&q=80',
                'badge' => 'Novo',
                'title' => 'Hambúrguer <span>Artesanal</span>',
                'description' => 'Pão brioche, carne 180g, queijo cheddar, bacon crocante e molho especial.',
                'button_text' => 'Peça Agora',
                'button_link' => '#menu'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?auto=format&fit=crop&w=1600&q=80',
                'image_food' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?auto=format&fit=crop&w=700&q=80',
                'badge' => 'Saudável',
                'title' => 'Salada <span>Primavera</span>',
                'description' => 'Mix de folhas frescas, tomate cereja, abacate, nozes e molho de mostarda e mel.',
                'button_text' => 'Ver Mais',
                'button_link' => '#menu'
            ]
        ];
        ?>
        <?php foreach ($slides as $key => $slide): ?>
            <div class="slide" style="background-image: url('<?php echo $slide['image']; ?>');">
                <div class="container">
                    <div class="row slide-content">
                        <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
                            <?php if (!empty($slide['badge'])): ?>
                                <div class="badge-off"><?php echo $slide['badge']; ?></div>
                            <?php endif; ?>
                            <h1><?php echo $slide['title']; ?></h1>
                            <p><?php echo $slide['description']; ?></p>
                            <div>
                                <a href="<?php echo $slide['button_link']; ?>" class="btn-hero">
                                    <?php echo $slide['button_text']; ?>
                                </a>
                                <a href="#contact" class="btn-hero-outline">Fale Conosco</a>
                            </div>
                        </div>
                        <div class="col-md-5" data-aos="fade-left" data-aos-delay="200">
                            <div class="hero-image">
                                <img src="<?php echo $slide['image_food']; ?>" alt="<?php echo strip_tags($slide['title']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- ============================================
         SEÇÃO SOBRE
         ============================================ -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="about-image">
                        <img src="<?php echo base_url('web/src/assets/img/photos/about-us.jpg'); ?>" alt="Sobre nós">
                        <div class="experience-badge">
                            <span class="number">15+</span>
                            <span class="label">Anos de Experiência</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 about-content" data-aos="fade-left">
                    <h2>Sobre <span>Nós</span></h2>
                    <p><?php echo esc($configuracao->sobre ?? 'Bem-vindo ao Food Delivery! Somos apaixonados por comida de qualidade e acreditamos que uma boa refeição pode transformar o dia de alguém.'); ?></p>
                    <p><?php echo esc($configuracao->sobreExtra ?? 'Trabalhamos com ingredientes frescos, selecionados e provenientes de produtores locais. Nossa equipe de chefs está constantemente criando novos sabores para surpreender você.'); ?></p>
                    <div class="features">
                        <div class="feature-item">
                            <i class="fa fa-cutlery"></i>
                            <span>Ingredientes Frescos</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-truck"></i>
                            <span>Entrega Rápida</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-star"></i>
                            <span>Chefes Premiados</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-heart"></i>
                            <span>Feito com Amor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         SEÇÃO CARDÁPIO
         ============================================ -->
    <section id="menu" class="menu-section">
        <div class="container">
            <?php
            $enderecoRestaurante = $configuracao->enderecoCompleto ?? ($configuracao->endereco ?? 'Seu endereço');
            $telefoneRestaurante = $configuracao->telefone ?? '(88) 99999-9999';
            $whatsappRestaurante = $configuracao->whatsapp ?? $telefoneRestaurante;
            $emailRestaurante = $configuracao->email ?? 'contato@fooddelivery.com';
            $redesSociais = $redesSociais ?? [];
            ?>
            <div class="section-header text-center" data-aos="fade-up">
                <h2>Nosso <span>Cardápio</span></h2>
                <p class="text-muted">Escolha sua categoria favorita e faça seu pedido!</p>
            </div>

            <!-- Tabs -->
            <div class="menu-tabs" data-aos="fade-up" data-aos-delay="100">
                <button class="tab-btn active" data-category="all">Todos</button>
                <?php if (!empty($categoriasMenu)): ?>
                    <?php foreach ($categoriasMenu as $categoria): ?>
                        <button class="tab-btn" data-category="<?php echo $categoria->slug; ?>">
                            <?php echo esc($categoria->nome); ?>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Menu Grid -->
            <div class="row" id="menuGrid" data-aos="fade-up" data-aos-delay="200">
                <?php if (!empty($categoriasMenu) && !empty($produtosPorCategoria)): ?>
                    <?php foreach ($categoriasMenu as $categoria): ?>
                        <?php
                        $produtos = $produtosPorCategoria[$categoria->id] ?? [];
                        foreach ($produtos as $produto):
                        ?>
                            <div class="col-md-4 col-sm-6 menu-item-wrapper" data-category="<?php echo $categoria->slug; ?>">
                                <div class="menu-item">
                                    <div class="menu-image">
                                        <?php
                                        $imagem = $produto->imagem_url ?? $produto->imagem ?? null;
                                        ?>
                                        <img src="<?php echo esc($imagem, 'attr'); ?>" alt="<?php echo esc($produto->nome); ?>">
                                        <?php if ($produto->destaque): ?>
                                            <span class="menu-badge">Destaque</span>
                                        <?php endif; ?>
                                        <div class="menu-overlay">
                                            <a href="<?php echo base_url('produto/' . $produto->slug); ?>">
                                                <i class="fa fa-search-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="menu-info">
                                        <h4><?php echo esc($produto->nome); ?></h4>
                                        <p><?php echo esc($produto->descricao_curta ?? 'Deliciosa opção do nosso cardápio.'); ?></p>
                                        <div class="menu-footer">
                                            <span class="price">R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?></span>
                                            <a href="<?php echo base_url('checkout'); ?>" class="btn-order">
                                                <i class="fa fa-shopping-cart"></i> Pedir
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">Nenhum produto disponível no momento.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ============================================
         SEÇÃO CONTATO
         ============================================ -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <h2>Entre em <span>Contato</span></h2>
                <p class="text-muted">Estamos aqui para atendê-lo. Entre em contato conosco!</p>
            </div>

            <div class="row">
                <!-- Informações de Contato -->
                <div class="col-md-5" data-aos="fade-right">
                    <div class="contact-info">
                        <div class="info-item">
                            <i class="fa fa-map-marker"></i>
                            <div class="info-text">
                                <h5>Endereço</h5>
                                <p><?php echo esc($enderecoRestaurante); ?></p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fa fa-phone"></i>
                            <div class="info-text">
                                <h5>Telefone</h5>
                                <p><?php echo esc($telefoneRestaurante); ?></p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fa fa-whatsapp"></i>
                            <div class="info-text">
                                <h5>WhatsApp</h5>
                                <p><?php echo esc($whatsappRestaurante); ?></p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fa fa-envelope"></i>
                            <div class="info-text">
                                <h5>E-mail</h5>
                                <p><?php echo esc($emailRestaurante); ?></p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fa fa-clock-o"></i>
                            <div class="info-text">
                                <h5>Horário de Funcionamento</h5>
                                <p>
                                    <?php if (!empty($horariosFuncionamento)): ?>
                                        <?php
                                        $dias = array_keys($horariosFuncionamento);
                                        $primeiro = reset($dias);
                                        $ultimo = end($dias);
                                        echo $primeiro . ' - ' . $ultimo . ': ';
                                        ?>
                                        <?php
                                        $horarios = array_filter($horariosFuncionamento, function ($h) {
                                            return !($h['fechado'] ?? false);
                                        });
                                        if (!empty($horarios)):
                                            $h = reset($horarios);
                                            echo ($h['abertura'] ?? '--:--') . ' - ' . ($h['fechamento'] ?? '--:--');
                                        else:
                                            echo 'Fechado';
                                        endif;
                                        ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="social-links">
                            <?php if (!empty($redesSociais)): ?>
                                <?php foreach ($redesSociais as $rede): ?>
                                    <?php $icone = $rede['icone'] ?? 'link'; ?>
                                    <a href="<?php echo esc($rede['url'] ?? '#', 'attr'); ?>" target="_blank" rel="noopener noreferrer" title="<?php echo esc($rede['nome'] ?? 'Rede social'); ?>">
                                        <i class="fa fa-<?php echo esc($icone); ?>"></i>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-whatsapp"></i></a>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Formulário de Contato -->
                <div class="col-md-7" data-aos="fade-left">
                    <div class="contact-form">
                        <h4>Envie uma Mensagem</h4>
                        <form id="contactForm" method="post" action="<?php echo base_url('contato/enviar'); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nome" class="form-control" placeholder="Seu nome" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Seu e-mail" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="assunto" class="form-control" placeholder="Assunto" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="telefone" class="form-control" placeholder="Seu telefone">
                            </div>
                            <div class="form-group">
                                <textarea name="mensagem" class="form-control" rows="5" placeholder="Sua mensagem..." required></textarea>
                            </div>
                            <button type="submit" class="btn-submit">
                                <i class="fa fa-paper-plane"></i> Enviar Mensagem
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         MAPA
         ============================================ -->
    <section class="map-section">
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.50924361069!2d-40.66840472322467!3d-5.1823149947952025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x796f5c8b073762f%3A0x57735386ef4fe331!2sR.%20Manoel%20Idelfonso%2C%20937%20-%20S%C3%A3o%20Vicente%2C%20Crate%C3%BAs%20-%20CE%2C%2063700-215!5e0!3m2!1spt-BR!2sbr!4v1783912688798!5m2!1spt-BR!2sbr"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin">
            </iframe>
        </div>
    </section>

    <!-- ============================================
         FOOTER
         ============================================ -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Sobre Nós</h4>
                    <p><?php echo esc($configuracao->sobreFooter ?? 'Food Delivery - Entregamos sabor e qualidade diretamente na sua casa.'); ?></p>
                    <div class="social-links">
                        <?php if (!empty($redesSociais)): ?>
                            <?php foreach ($redesSociais as $rede): ?>
                                <?php $icone = $rede['icone'] ?? 'link'; ?>
                                <a href="<?php echo esc($rede['url'] ?? '#', 'attr'); ?>" target="_blank" rel="noopener noreferrer" title="<?php echo esc($rede['nome'] ?? 'Rede social'); ?>">
                                    <i class="fa fa-<?php echo esc($icone); ?>"></i>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-whatsapp"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4>Links Rápidos</h4>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">Sobre</a></li>
                        <li><a href="#menu">Cardápio</a></li>
                        <li><a href="#contact">Contato</a></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <h4>Horário de Funcionamento</h4>
                    <?php if (!empty($horariosFuncionamento)): ?>
                        <?php foreach ($horariosFuncionamento as $dia => $horario): ?>
                            <p style="color: #aaa; margin: 5px 0; display: flex; justify-content: space-between;">
                                <span><?php echo $dia; ?></span>
                                <span>
                                    <?php if ($horario['fechado'] ?? false): ?>
                                        <span style="color: #e74c3c;">Fechado</span>
                                    <?php else: ?>
                                        <?php echo $horario['abertura'] ?? '--:--'; ?> - <?php echo $horario['fechamento'] ?? '--:--'; ?>
                                    <?php endif; ?>
                                </span>
                            </p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>">Food Delivery</a> - Todos os direitos reservados.</p>
                <p style="margin-top: 5px; font-size: 12px; color: #555;">
                    <i class="fa fa-map-marker"></i> R. Manoel Idelfonso, 937 - São Vicente, Crateús - CE
                </p>
            </div>
        </div>
    </footer>

</div>
<!-- END body-wrapper -->

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<!-- JavaScript do Template - Caminhos corrigidos -->
<script src="<?php echo base_url('web/src/assets/js/jquery-2.1.1.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/slick.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/aos.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/jquery.fancybox.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/jquery.mousewheel.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/jquery.easing.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/scrolling-nav.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/jquery.touchSwipe.min.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/moment.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/bootstrap-datetimepicker.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/loadMoreResults.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/main.js'); ?>"></script>
<!-- JS Personalizado -->
<script src="<?php echo base_url('web/src/assets/js/delivery-custom.js'); ?>"></script>
<script src="<?php echo base_url('web/src/assets/js/home.js'); ?>"></script>
<?php echo $this->endSection(); ?>