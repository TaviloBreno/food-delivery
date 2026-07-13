/**
 * ============================================
 * HOME PAGE - JavaScript Personalizado
 * ============================================
 */

$(document).ready(function() {

    // ============================================
    // 1. INICIALIZAR AOS (Animações)
    // ============================================
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
    }

    // ============================================
    // 2. INICIALIZAR HERO SLIDER (Slick)
    // ============================================
    if ($('.hero-slider').length && typeof $.fn.slick !== 'undefined') {
        $('.hero-slider').slick({
            dots: true,
            arrows: true,
            infinite: true,
            speed: 800,
            fade: true,
            autoplay: true,
            autoplaySpeed: 15000,
            pauseOnHover: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
            responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    dots: true
                }
            }]
        });

        // Pausar autoplay ao interagir
        $('.hero-slider').on('mouseenter', function() {
            $(this).slick('slickPause');
        });

        $('.hero-slider').on('mouseleave', function() {
            $(this).slick('slickPlay');
        });
    }

    // ============================================
    // 3. ANIMAÇÃO PERSONALIZADA - TEXTO DIGITADO
    // ============================================
    function typeWriter() {
        var textElement = document.querySelector('.hero-slider .slide-content h1');
        if (!textElement) return;

        // Guardar o texto original
        var originalText = textElement.textContent;
        var letters = originalText.split('');
        var index = 0;

        // Limpar o texto
        textElement.textContent = '';

        function type() {
            if (index < letters.length) {
                // Adicionar letra por letra com efeito de digitação
                textElement.textContent += letters[index];
                index++;
                // Velocidade variável para efeito natural
                var speed = Math.random() * 60 + 40;
                setTimeout(type, speed);
            }
        }

        // Iniciar animação apenas na primeira vez que o slide carregar
        // Verificar se é o slide ativo
        if ($('.hero-slider .slick-active').length) {
            // Aguardar um pouco para o carregamento
            setTimeout(type, 500);
        }

        // Observar mudanças de slide
        $('.hero-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            // Resetar texto para o novo slide
            setTimeout(function() {
                var newTextElement = $('.slick-active .slide-content h1');
                if (newTextElement.length) {
                    var newText = newTextElement.text().trim();
                    newTextElement.text('');
                    typeWriterSlide(newTextElement);
                }
            }, 400);
        });
    }

    // Função para digitar texto em um elemento específico
    function typeWriterSlide(element) {
        var originalText = element.text().trim();
        var letters = originalText.split('');
        var index = 0;

        element.text('');

        function type() {
            if (index < letters.length) {
                element.text(element.text() + letters[index]);
                index++;
                var speed = Math.random() * 60 + 40;
                setTimeout(type, speed);
            }
        }

        setTimeout(type, 300);
    }

    // ============================================
    // 4. ANIMAÇÃO PERSONALIZADA - CORAÇÃO FLUTUANTE
    // ============================================
    function createFloatingHeart() {
        // Apenas em desktop
        if (window.innerWidth < 768) return;

        var heart = $('<i class="fa fa-heart floating-heart"></i>');
        var colors = ['#e74c3c', '#ff6b6b', '#ff4757', '#ff6348', '#e74c3c'];
        var color = colors[Math.floor(Math.random() * colors.length)];

        var startX = Math.random() * 100; // % da largura
        var size = Math.random() * 20 + 15; // 15-35px

        heart.css({
            'position': 'fixed',
            'bottom': '-30px',
            'left': startX + '%',
            'font-size': size + 'px',
            'color': color,
            'opacity': 0.3 + Math.random() * 0.4,
            'z-index': '9998',
            'pointer-events': 'none'
        });

        $('body').append(heart);

        // Animar com jQuery
        heart.animate({
            bottom: '100vh',
            opacity: 0,
            left: (startX + (Math.random() * 20 - 10)) + '%',
            rotate: Math.random() * 360
        }, {
            duration: 8000 + Math.random() * 4000,
            easing: 'linear',
            complete: function() {
                $(this).remove();
            }
        });
    }

    // Criar corações a cada 3-5 segundos
    if ($('.hero-slider').length) {
        setInterval(function() {
            createFloatingHeart();
        }, 3000 + Math.random() * 2000);
    }

    // ============================================
    // 5. ANIMAÇÃO PERSONALIZADA - PARALLAX SUAVE
    // ============================================
    $(window).on('scroll', function() {
        var scrollPos = $(window).scrollTop();
        var windowHeight = $(window).height();

        // Efeito parallax no hero
        $('.hero-slider .slide').each(function() {
            var element = $(this);
            var offset = element.offset().top;
            var speed = 0.3;

            if (scrollPos >= offset - windowHeight && scrollPos <= offset + windowHeight) {
                var yPos = -(scrollPos - offset) * speed;
                element.find('.slide-content .hero-image').css({
                    'transform': 'translateY(' + yPos + 'px)'
                });
            }
        });

        // Efeito de fade-in nos elementos ao rolar
        $('.menu-item, .feature-item, .info-item').each(function() {
            var element = $(this);
            var offset = element.offset().top;
            var elementHeight = element.outerHeight();

            if (scrollPos + windowHeight > offset + elementHeight / 2) {
                element.addClass('fade-visible');
            }
        });
    });

    // ============================================
    // 6. FILTRO DO CARDÁPIO
    // ============================================
    $('.tab-btn').on('click', function() {
        var category = $(this).data('category');

        // Atualizar botões ativos
        $('.tab-btn').removeClass('active');
        $(this).addClass('active');

        // Filtrar itens do cardápio com animação
        if (category === 'all') {
            $('.menu-item-wrapper').fadeIn(400);
        } else {
            $('.menu-item-wrapper').fadeOut(200);
            setTimeout(function() {
                $('.menu-item-wrapper[data-category="' + category + '"]').fadeIn(400);
            }, 300);
        }
    });

    // ============================================
    // 7. SCROLL SUAVE PARA ÂNCORAS
    // ============================================
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this).attr('href');

        if (target === '#' || target === '') {
            return;
        }

        e.preventDefault();

        var offset = 70; // Altura do navbar
        var targetElement = $(target);

        if (targetElement.length) {
            $('html, body').animate({
                scrollTop: targetElement.offset().top - offset
            }, 800, 'easeInOutQuart');
        }
    });

    // ============================================
    // 8. NAVBAR - ACTIVE LINK ON SCROLL
    // ============================================
    var sections = $('section[id]');

    $(window).on('scroll', function() {
        var scrollPos = $(window).scrollTop() + 100;

        sections.each(function() {
            var top = $(this).offset().top;
            var bottom = top + $(this).outerHeight();
            var id = $(this).attr('id');

            if (scrollPos >= top && scrollPos < bottom) {
                $('.navbar-nav .active').removeClass('active');
                $('.navbar-nav a[href="#' + id + '"]').parent().addClass('active');
            }
        });
    });

    // ============================================
    // 9. NAVBAR - SCROLL EFFECT
    // ============================================
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 50) {
            $('.navbar-custom').css({
                'background': 'rgba(26, 26, 26, 0.98) !important',
                'box-shadow': '0 2px 20px rgba(0,0,0,0.3)'
            });
        } else {
            $('.navbar-custom').css({
                'background': 'rgba(26, 26, 26, 0.95) !important',
                'box-shadow': 'none'
            });
        }
    });

    // ============================================
    // 10. NAVBAR - Toggle fix para mobile
    // ============================================
    $('.navbar-toggle').on('click', function() {
        var expanded = $(this).attr('aria-expanded') === 'true' ? false : true;
        $(this).attr('aria-expanded', expanded);
    });

    // Fechar menu mobile ao clicar em um link
    $('.navbar-nav a').on('click', function() {
        if ($('.navbar-toggle').is(':visible')) {
            $('.navbar-toggle').click();
        }
    });

    // ============================================
    // 11. VALIDAÇÃO DO FORMULÁRIO DE CONTATO
    // ============================================
    $('#contactForm').on('submit', function(e) {
        var isValid = true;
        var form = $(this);

        form.find('input[required], textarea[required]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                $(this).css('border-color', '#e74c3c');
                $(this).attr('placeholder', '⚠️ ' + $(this).attr('placeholder'));
            } else {
                $(this).css('border-color', '#2ecc71');
            }
        });

        if (!isValid) {
            e.preventDefault();
            showNotification('Por favor, preencha todos os campos obrigatórios.', 'error');
            return false;
        }

        // Validar email
        var email = form.find('input[name="email"]').val();
        if (email && !isValidEmail(email)) {
            e.preventDefault();
            showNotification('Por favor, insira um e-mail válido.', 'error');
            return false;
        }
    });

    // Remover erro ao digitar
    $('#contactForm input, #contactForm textarea').on('input', function() {
        if ($(this).val().trim() !== '') {
            $(this).css('border-color', '#2ecc71');
        }
    });

    // ============================================
    // 12. FUNÇÃO DE VALIDAÇÃO DE EMAIL
    // ============================================
    function isValidEmail(email) {
        var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return regex.test(email);
    }

    // ============================================
    // 13. FUNÇÃO DE NOTIFICAÇÃO
    // ============================================
    function showNotification(message, type) {
        var notification = $('<div class="notification">' +
            '<div class="notification-content">' +
            '<i class="fa ' + (type === 'error' ? 'fa-times-circle' : 'fa-check-circle') + '"></i>' +
            '<span>' + message + '</span>' +
            '</div>' +
            '</div>');

        notification.css({
            'position': 'fixed',
            'top': '20px',
            'right': '20px',
            'z-index': '9999',
            'padding': '15px 25px',
            'border-radius': '10px',
            'background': type === 'error' ? '#e74c3c' : '#2ecc71',
            'color': '#fff',
            'font-weight': '600',
            'box-shadow': '0 10px 40px rgba(0,0,0,0.2)',
            'opacity': '0',
            'transform': 'translateX(100px)',
            'transition': 'all 0.5s ease',
            'max-width': '400px'
        });

        $('body').append(notification);

        setTimeout(function() {
            notification.css({
                'opacity': '1',
                'transform': 'translateX(0)'
            });
        }, 100);

        setTimeout(function() {
            notification.css({
                'opacity': '0',
                'transform': 'translateX(100px)'
            });
            setTimeout(function() {
                notification.remove();
            }, 500);
        }, 5000);
    }

    // ============================================
    // 14. MÁSCARA DE TELEFONE
    // ============================================
    $('input[name="telefone"]').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length <= 11) {
            value = value.replace(/^(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d)(\d{4})$/, '$1-$2');
            $(this).val(value);
        }
    });

    // ============================================
    // 15. ANIMAÇÃO DE CARREGAMENTO DOS ITENS
    // ============================================
    // Adicionar classe para animação de fade-in
    $('.menu-item-wrapper, .feature-item, .info-item').addClass('fade-item');

    // ============================================
    // 16. INICIAR ANIMAÇÃO DE TEXTO DIGITADO
    // ============================================
    // Aguardar carregamento completo
    $(window).on('load', function() {
        setTimeout(function() {
            typeWriter();
        }, 500);
    });

    // ============================================
    // 17. ANIMAÇÃO DE CONTAGEM (Stats)
    // ============================================
    function animateCounter(element, target, duration) {
        var start = 0;
        var step = Math.ceil(target / (duration / 16));

        function updateCounter() {
            start += step;
            if (start >= target) {
                element.text(target + '+');
                return;
            }
            element.text(start + '+');
            requestAnimationFrame(updateCounter);
        }

        updateCounter();
    }

    // Iniciar contadores quando a seção about for visível
    var aboutSection = document.querySelector('#about');
    var counterElement = document.querySelector('.experience-badge .number');

    if (counterElement) {
        var targetNumber = parseInt(counterElement.textContent);
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounter(counterElement, targetNumber, 2000);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(aboutSection);
    }

    // ============================================
    // 18. ANIMAÇÃO DE ENTRADA DOS SLIDES
    // ============================================
    $('.hero-slider').on('afterChange', function(event, slick, currentSlide) {
        // Adicionar classe de animação ao slide atual
        var currentSlideElement = $('.slick-active .slide-content');
        currentSlideElement.addClass('slide-enter');

        setTimeout(function() {
            currentSlideElement.removeClass('slide-enter');
        }, 1000);
    });

    console.log('🍕 Food Delivery - Home page carregada com sucesso!');
    console.log('📍 Localização: R. Manoel Idelfonso, 937 - São Vicente, Crateús - CE');
    console.log('🏠 Food Delivery - Entregamos sabor e qualidade!');
});