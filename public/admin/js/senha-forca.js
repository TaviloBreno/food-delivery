$(document).ready(function() {
    var $senhaInput = $('#senha');
    var $container = $senhaInput.closest('.senha-container');

    if ($container.length === 0) {
        $senhaInput.wrap('<div class="senha-container"></div>');
        $container = $senhaInput.closest('.senha-container');
    }

    var $dicaTopo = $(
        '<div class="senha-dica-topo">' +
        '<span class="icone-dica">💡</span> ' +
        'Mínimo 8 caracteres, com letras maiúsculas, minúsculas, números e caracteres especiais.' +
        '</div>'
    );
    $container.append($dicaTopo);

    var $forcaHtml = $(
        '<div class="senha-forca">' +
        '<div class="progress">' +
        '<div class="progress-bar" role="progressbar" style="width: 0%;"></div>' +
        '</div>' +
        '<div class="texto-forca">' +
        '<span class="label-forca">Digite uma senha</span>' +
        '<span class="porcentagem-forca">0%</span>' +
        '</div>' +
        '<div class="requisitos">' +
        '<div class="requisito-item requisito-tamanho nao-atendido">' +
        '<span class="icone-status">✗</span>' +
        '<span class="texto-requisito">8 caracteres</span>' +
        '</div>' +
        '<div class="requisito-item requisito-maiuscula nao-atendido">' +
        '<span class="icone-status">✗</span>' +
        '<span class="texto-requisito">Maiúscula</span>' +
        '</div>' +
        '<div class="requisito-item requisito-minuscula nao-atendido">' +
        '<span class="icone-status">✗</span>' +
        '<span class="texto-requisito">Minúscula</span>' +
        '</div>' +
        '<div class="requisito-item requisito-numero nao-atendido">' +
        '<span class="icone-status">✗</span>' +
        '<span class="texto-requisito">Número</span>' +
        '</div>' +
        '<div class="requisito-item requisito-especial nao-atendido">' +
        '<span class="icone-status">✗</span>' +
        '<span class="texto-requisito">Especial</span>' +
        '</div>' +
        '</div>' +
        '</div>'
    );

    $container.append($forcaHtml);

    function avaliarSenha(senha) {
        var requisitos = {
            tamanho: senha.length >= 8,
            maiuscula: /[A-Z]/.test(senha),
            minuscula: /[a-z]/.test(senha),
            numero: /\d/.test(senha),
            especial: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(senha)
        };

        var atendidos = Object.values(requisitos).filter(Boolean).length;
        var total = Object.keys(requisitos).length;
        var porcentagem = Math.round((atendidos / total) * 100);

        return { requisitos, atendidos, total, porcentagem };
    }

    function atualizarRequisitos(requisitos) {
        var map = {
            tamanho: '.requisito-tamanho',
            maiuscula: '.requisito-maiuscula',
            minuscula: '.requisito-minuscula',
            numero: '.requisito-numero',
            especial: '.requisito-especial'
        };

        for (var key in map) {
            var $item = $(map[key]);
            var $icone = $item.find('.icone-status');

            if (requisitos[key]) {
                $item.removeClass('nao-atendido').addClass('atendido');
                $icone.text('✓');
            } else {
                $item.removeClass('atendido').addClass('nao-atendido');
                $icone.text('✗');
            }
        }
    }

    function obterClassificacao(porcentagem) {
        if (porcentagem === 0) return { texto: 'Digite uma senha', classe: '' };
        if (porcentagem < 20) return { texto: 'Muito fraca', classe: 'muito-fraca' };
        if (porcentagem < 40) return { texto: 'Fraca', classe: 'fraca' };
        if (porcentagem < 60) return { texto: 'Média', classe: 'media' };
        if (porcentagem < 80) return { texto: 'Forte', classe: 'forte' };
        return { texto: 'Muito forte', classe: 'muito-forte' };
    }

    function obterCor(porcentagem) {
        if (porcentagem === 0) return '#6c757d';
        if (porcentagem < 20) return '#dc3545';
        if (porcentagem < 40) return '#fd7e14';
        if (porcentagem < 60) return '#ffc107';
        if (porcentagem < 80) return '#28a745';
        return '#20c997';
    }

    function atualizarForca(senha) {
        var $barra = $('.senha-forca .progress-bar');
        var $label = $('.senha-forca .label-forca');
        var $porcentagem = $('.senha-forca .porcentagem-forca');
        var $textoForca = $('.senha-forca .texto-forca');
        var $dicaTopo = $('.senha-dica-topo');

        if (senha.length === 0) {
            $barra.css({ width: '0%', backgroundColor: '#e9ecef' });
            $label.text('Digite uma senha');
            $porcentagem.text('0%');
            $textoForca.removeClass('muito-fraca fraca media forte muito-forte');
            $dicaTopo.show();
            return;
        }

        $dicaTopo.hide();

        var resultado = avaliarSenha(senha);
        var classificacao = obterClassificacao(resultado.porcentagem);
        var cor = obterCor(resultado.porcentagem);

        $barra.css({
            width: resultado.porcentagem + '%',
            backgroundColor: cor
        });

        $label.text(classificacao.texto);
        $porcentagem.text(resultado.porcentagem + '%');
        $textoForca.removeClass('muito-fraca fraca media forte muito-forte');
        if (classificacao.classe) {
            $textoForca.addClass(classificacao.classe);
        }

        atualizarRequisitos(resultado.requisitos);
    }

    $senhaInput.on('input', function() {
        atualizarForca($(this).val());
    });

    if ($senhaInput.val().length > 0) {
        atualizarForca($senhaInput.val());
    } else {
        $('.senha-dica-topo').show();
    }
});