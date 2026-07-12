/**
 * Módulo de Usuários - Formulário
 */
(function() {
    'use strict';

    // 🔥 Configurações
    const CONFIG = {
        formSelector: 'form.forms-sample',
        cpfSelector: '#cpf',
        telefoneSelector: '#telefone',
        senhaSelector: '#senha',
        senhaConfirmacaoSelector: '#senha_confirmacao',
        maskOptions: {
            cpf: '000.000.000-00',
            telefone: '(00) 00000-0000'
        }
    };

    // 🔥 Inicialização
    function init() {
        setupMasks();
        setupPasswordValidation();
        setupAutoClearInputs();
    }

    // 🔥 Máscaras
    function setupMasks() {
        if (typeof $.fn.mask === 'undefined') {
            console.warn('jQuery Mask não carregado');
            return;
        }

        const $cpf = $(CONFIG.cpfSelector);
        const $telefone = $(CONFIG.telefoneSelector);

        if ($cpf.length) {
            $cpf.mask(CONFIG.maskOptions.cpf);
        }

        if ($telefone.length) {
            $telefone.mask(CONFIG.maskOptions.telefone);
        }
    }

    // 🔥 Validação de senha em tempo real
    function setupPasswordValidation() {
        const $senha = $(CONFIG.senhaSelector);
        const $confirmacao = $(CONFIG.senhaConfirmacaoSelector);

        if ($senha.length === 0 || $confirmacao.length === 0) {
            return;
        }

        $senha.add($confirmacao).on('keyup', function() {
            const senha = $senha.val();
            const confirmacao = $confirmacao.val();

            if (senha.length > 0 && confirmacao.length > 0) {
                if (senha === confirmacao) {
                    $confirmacao.css('border-color', '#28a745');
                } else {
                    $confirmacao.css('border-color', '#dc3545');
                }
            } else {
                $confirmacao.css('border-color', '');
            }
        });
    }

    // 🔥 Auto-clear inputs
    function setupAutoClearInputs() {
        const inputs = ['#nome', '#email', '#cpf', '#telefone'];
        
        inputs.forEach(function(selector) {
            const $input = $(selector);
            if ($input.length === 0) return;

            let isCleared = false;

            $input.on('focus', function() {
                $(this).select();
                isCleared = false;
            });

            $input.on('keydown', function(e) {
                const navigationKeys = [
                    9, 13, 16, 17, 18, 20, 27, 35, 36, 37, 38, 39, 40, 45, 46
                ];

                if (navigationKeys.includes(e.keyCode) || e.ctrlKey || e.metaKey) {
                    return true;
                }

                if (!isCleared && $(this).val().length > 0) {
                    $(this).val('');
                    isCleared = true;
                }
            });

            $input.on('blur', function() {
                isCleared = false;
            });
        });
    }

    // 🔥 Iniciar quando o DOM estiver pronto
    $(document).ready(init);

})();