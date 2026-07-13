/**
 * ============================================
 * DELIVERY CUSTOM JS - Butazzo Pizza Template
 * ============================================
 */

$(document).ready(function() {

    // ========================================
    // 1. INICIALIZAR AOS (Animações)
    // ========================================
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100,
        disable: 'mobile'
    });

    // ========================================
    // 2. FILTRO DO CARDÁPIO
    // ========================================
    $('.filter-button').on('click', function(e) {
        e.preventDefault();

        var filter = $(this).data('filter');

        // Remove active class de todos os itens
        $('.menu_filter .item').removeClass('active');
        $(this).closest('.item').addClass('active');

        // Mostra/Esconde os itens do cardápio
        if (filter === 'all') {
            $('.filtr-item').show();
        } else {
            $('.filtr-item').hide();
            $('.filtr-item.filter.' + filter).show();
        }
    });

    // ========================================
    // 3. DATE PICKER
    // ========================================
    if ($('#reserv_date').length) {
        $('#reserv_date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: new Date()
        });
    }

    if ($('#reserv_time').length) {
        $('#reserv_time').datetimepicker({
            format: 'HH:ii',
            pickerPosition: 'bottom-left',
            startView: 1,
            minuteStep: 15,
            autoclose: true
        });
    }

    // ========================================
    // 4. BUSCA COM ATALHO (Ctrl + K)
    // ========================================
    $(document).on('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            $('#search').click();
            $('#navbar_search input').focus();
        }
    });

    // ========================================
    // 5. TOGGLE DA BUSCA
    // ========================================
    $('#search').on('click', function() {
        $('#navbar_search').slideToggle(300);
        $('#navbar_search input').focus();
    });

    $('#search_close').on('click', function(e) {
        e.preventDefault();
        $('#navbar_search').slideUp(300);
    });

    // ========================================
    // 6. SCROLL SUAVE (Page Scroll)
    // ========================================
    $('.page-scroll').on('click', function(e) {
        e.preventDefault();

        var target = $(this).attr('href');
        var offset = 80; // Altura do header fixo

        if (target === '#header') {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
        } else {
            $('html, body').animate({
                scrollTop: $(target).offset().top - offset
            }, 800);
        }

        // Fecha menu mobile se estiver aberto
        if ($('.cd-nav-container').hasClass('is-visible')) {
            $('.cd-nav-container').removeClass('is-visible');
            $('.cd-overlay').removeClass('is-visible');
            $('body').removeClass('cd-overlay');
        }
    });

    // ========================================
    // 7. SCROLL PARA O TOPO
    // ========================================
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn(200);
        } else {
            $('.back-to-top').fadeOut(200);
        }
    });

    // ========================================
    // 8. LOADING OVERLAY
    // ========================================
    $(window).on('load', function() {
        $('.loading-overlay').fadeOut(500);
    });

    // ========================================
    // 9. FANCYBOX (Galeria)
    // ========================================
    $('.fancybox').fancybox({
        openEffect: 'elastic',
        closeEffect: 'elastic',
        helpers: {
            title: {
                type: 'inside'
            }
        }
    });

    // ========================================
    // 10. VALIDAÇÃO DO FORMULÁRIO DE RESERVA
    // ========================================
    $('#reserv_form').on('submit', function(e) {
        var isValid = true;

        $(this).find('input[required], textarea[required]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
                $(this).next('.form_icon').addClass('text-danger');
            } else {
                $(this).removeClass('is-invalid');
                $(this).next('.form_icon').removeClass('text-danger');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Por favor, preencha todos os campos obrigatórios.');
        }
    });

    // ========================================
    // 11. MÁSCARA DE TELEFONE
    // ========================================
    $('input[name="telefone"]').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length <= 11) {
            value = value.replace(/^(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d)(\d{4})$/, '$1-$2');
            $(this).val(value);
        }
    });

    // ========================================
    // 12. RESPONSIVIDADE DO MENU
    // ========================================
    var $nav = $('.navbar');
    var $menu = $('#navbar');
    var $toggle = $('.navbar-toggle');

    $(window).on('resize', function() {
        if ($(window).width() > 768) {
            $menu.collapse('show');
        }
    });

    // ========================================
    // 13. GOOGLE MAPS
    // ========================================
    window.myMap = function() {
        if (typeof google === 'undefined' || !document.getElementById('googleMap')) {
            return;
        }

        var mapOptions = {
            center: new google.maps.LatLng(-23.5505, -46.6333), // São Paulo como exemplo
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        };

        var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

        // Marker personalizado
        var marker = new google.maps.Marker({
            position: mapOptions.center,
            map: map,
            title: 'Food Delivery',
            icon: {
                url: baseUrl + 'web/src/assets/img/favicon/favicon-32x32.png',
                scaledSize: new google.maps.Size(40, 40)
            }
        });

        // Info Window
        var infoWindow = new google.maps.InfoWindow({
            content: '<div style="padding:10px;"><strong>Food Delivery</strong><br>Nosso restaurante aqui!</div>'
        });

        marker.addListener('click', function() {
            infoWindow.open(map, marker);
        });
    };

    // ========================================
    // 14. CARREGAR MAIS (Load More)
    // ========================================
    if (typeof loadMoreResults === 'function') {
        loadMoreResults({
            container: '.loadMore',
            items: '.item',
            loadMoreButton: '#loadMoreBtn',
            limit: 8,
            animation: 'fadeIn'
        });
    }

    // ========================================
    // 15. NOTIFICAÇÕES DE SUCESSO/ERRO
    // ========================================
    var flashMessage = $('.flash-message');
    if (flashMessage.length) {
        setTimeout(function() {
            flashMessage.fadeOut(500);
        }, 5000);
    }

});

console.log('🍕 Food Delivery - Butazzo Pizza Template carregado com sucesso!');