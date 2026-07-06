$(document).ready(function() {
    function setupAutoClearInput(inputId) {
        var $input = $('#' + inputId);
        var isCleared = false;
        
        $input.on('focus', function() {
            $(this).select();
            isCleared = false;
        });
        
        $input.on('keydown', function(e) {
            var navigationKeys = [9, 13, 16, 17, 18, 20, 27, 35, 36, 37, 38, 39, 40, 45, 46];
            
            if (navigationKeys.includes(e.keyCode) || e.ctrlKey || e.metaKey) {
                return true;
            }
            
            if (!isCleared && $input.val().length > 0) {
                $input.val('');
                isCleared = true;
            }
        });
        
        $input.on('blur', function() {
            isCleared = false;
        });
    }
    
    function setupAutoClearMaskedInput(inputId, maskPattern) {
        var $input = $('#' + inputId);
        var isCleared = false;
        
        $input.on('focus', function() {
            $(this).select();
            isCleared = false;
        });
        
        $input.on('keydown', function(e) {
            var navigationKeys = [9, 13, 16, 17, 18, 20, 27, 35, 36, 37, 38, 39, 40, 45, 46];
            
            if (navigationKeys.includes(e.keyCode) || e.ctrlKey || e.metaKey) {
                return true;
            }
            
            if (!isCleared && $input.val().length > 0) {
                $input.val('');
                isCleared = true;
            }
            
            if ($input.val().length === 0) {
                $input.mask(maskPattern);
            }
        });
        
        $input.on('blur', function() {
            var value = $(this).val().replace(/\D/g, '');
            
            if (value.length > 0) {
                var masked = '';
                if (inputId === 'cpf') {
                    masked = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
                } else if (inputId === 'telefone') {
                    if (value.length === 10) {
                        masked = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                    } else if (value.length === 11) {
                        masked = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                    } else {
                        masked = value;
                    }
                }
                $(this).val(masked);
            } else {
                $(this).val('');
            }
            
            isCleared = false;
        });
    }
    
    setupAutoClearInput('nome');
    setupAutoClearInput('email');
    setupAutoClearMaskedInput('cpf', '000.000.000-00');
    setupAutoClearMaskedInput('telefone', '(00) 00000-0000');
    
    $('#senha, #senha_confirmacao').on('keyup', function() {
        var senha = $('#senha').val();
        var confirmacao = $('#senha_confirmacao').val();
        
        if (senha.length > 0 && confirmacao.length > 0) {
            if (senha === confirmacao) {
                $('#senha_confirmacao').css('border-color', '#28a745');
            } else {
                $('#senha_confirmacao').css('border-color', '#dc3545');
            }
        } else {
            $('#senha_confirmacao').css('border-color', '');
        }
    });
    
    $('form').on('submit', function(e) {
        var nome = $('#nome').val().trim();
        var email = $('#email').val().trim();
        var cpf = $('#cpf').val().trim();
        var telefone = $('#telefone').val().trim();
        var senha = $('#senha').val();
        var senhaConfirmacao = $('#senha_confirmacao').val();
        var isEdit = $('input[name="_method"]').length > 0;
        
        if (nome.length < 3) {
            alert('O nome deve ter pelo menos 3 caracteres.');
            e.preventDefault();
            return false;
        }
        
        if (!email.includes('@') || !email.includes('.')) {
            alert('Digite um email válido.');
            e.preventDefault();
            return false;
        }
        
        if (cpf.length > 0) {
            var cpfClean = cpf.replace(/\D/g, '');
            if (cpfClean.length !== 11) {
                alert('Digite um CPF válido com 11 números.');
                e.preventDefault();
                return false;
            }
        }
        
        if (telefone.length > 0) {
            var telefoneClean = telefone.replace(/\D/g, '');
            if (telefoneClean.length !== 10 && telefoneClean.length !== 11) {
                alert('Digite um telefone válido com 10 ou 11 números.');
                e.preventDefault();
                return false;
            }
        }
        
        if (!isEdit) {
            if (senha.length < 8) {
                alert('A senha deve ter pelo menos 8 caracteres.');
                e.preventDefault();
                return false;
            }
            
            if (senha !== senhaConfirmacao) {
                alert('As senhas não coincidem.');
                e.preventDefault();
                return false;
            }
        } else {
            if (senha.length > 0 || senhaConfirmacao.length > 0) {
                if (senha.length < 8) {
                    alert('A senha deve ter pelo menos 8 caracteres.');
                    e.preventDefault();
                    return false;
                }
                
                if (senha !== senhaConfirmacao) {
                    alert('As senhas não coincidem.');
                    e.preventDefault();
                    return false;
                }
            }
        }
        
        $('#cpf').val($('#cpf').val().replace(/\D/g, ''));
        $('#telefone').val($('#telefone').val().replace(/\D/g, ''));
        
        return true;
    });
});