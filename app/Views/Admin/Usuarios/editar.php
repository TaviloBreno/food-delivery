<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo esc($titulo); ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<style>
    .masked-input:focus {
        background-color: #f8f9fa;
        border-color: #4d83ff;
        box-shadow: 0 0 0 0.2rem rgba(77, 131, 255, 0.25);
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body bg-primary pb-0 pt-4">
                <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>
            </div>
            
            <div class="card-body">
                <form class="forms-sample" action="<?php echo site_url('admin/usuarios/atualizar/' . $usuario->id); ?>" method="POST">
                    
                    <?php echo csrf_field(); ?>
                    
                    <input type="hidden" name="_method" value="PUT">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome completo</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nome" 
                                       name="nome" 
                                       value="<?php echo esc($usuario->nome); ?>"
                                       placeholder="Digite o nome completo"
                                       autocomplete="off"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       value="<?php echo esc($usuario->email); ?>"
                                       placeholder="Digite o email"
                                       autocomplete="off"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" 
                                       class="form-control masked-input" 
                                       id="cpf" 
                                       name="cpf" 
                                       value="<?php echo esc($usuario->cpf); ?>"
                                       placeholder="Digite o CPF"
                                       autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" 
                                       class="form-control masked-input" 
                                       id="telefone" 
                                       name="telefone" 
                                       value="<?php echo esc($usuario->telefone); ?>"
                                       placeholder="Digite o telefone"
                                       autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="senha">Nova senha</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="senha" 
                                       name="senha" 
                                       placeholder="Digite a nova senha (opcional)"
                                       autocomplete="off">
                                <small class="text-muted">Deixe em branco para manter a senha atual</small>
                            </div>

                            <div class="form-group">
                                <label for="senha_confirmacao">Confirmar nova senha</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="senha_confirmacao" 
                                       name="senha_confirmacao" 
                                       placeholder="Confirme a nova senha"
                                       autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                                <input type="radio" 
                                                       class="form-check-input" 
                                                       name="ativo" 
                                                       id="ativoSim" 
                                                       value="1"
                                                       <?php echo ($usuario->ativo == 1 ? 'checked' : ''); ?>>
                                                Ativo
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-danger">
                                            <label class="form-check-label">
                                                <input type="radio" 
                                                       class="form-check-input" 
                                                       name="ativo" 
                                                       id="ativoNao" 
                                                       value="0"
                                                       <?php echo ($usuario->ativo == 0 ? 'checked' : ''); ?>>
                                                Inativo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Permissão</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                                <input type="radio" 
                                                       class="form-check-input" 
                                                       name="is_admin" 
                                                       id="isAdminSim" 
                                                       value="1"
                                                       <?php echo ($usuario->is_admin == 1 ? 'checked' : ''); ?>>
                                                Administrador
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-secondary">
                                            <label class="form-check-label">
                                                <input type="radio" 
                                                       class="form-check-input" 
                                                       name="is_admin" 
                                                       id="isAdminNao" 
                                                       value="0"
                                                       <?php echo ($usuario->is_admin == 0 ? 'checked' : ''); ?>>
                                                Usuário comum
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="mdi mdi-content-save"></i> Salvar alterações
                        </button>
                        <a href="<?php echo site_url('admin/usuarios'); ?>" class="btn btn-danger ml-2">
                            <i class="mdi mdi-arrow-left"></i> Cancelar
                        </a>
                        <a href="<?php echo site_url('admin/usuarios/show/' . $usuario->id); ?>" class="btn btn-info ml-2">
                            <i class="mdi mdi-eye"></i> Ver detalhes
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script src="<?php echo site_url('admin/vendors/jquery-mask/jquery.mask.min.js'); ?>"></script>

<script>
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
    
    setupAutoClearInput('nome');
    setupAutoClearInput('email');
    
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
        
        if (senha.length > 0 || senhaConfirmacao.length > 0) {
            if (senha.length < 6) {
                alert('A senha deve ter pelo menos 6 caracteres.');
                e.preventDefault();
                return false;
            }
            
            if (senha !== senhaConfirmacao) {
                alert('As senhas não coincidem.');
                e.preventDefault();
                return false;
            }
        }
        
        $('#cpf').val($('#cpf').val().replace(/\D/g, ''));
        $('#telefone').val($('#telefone').val().replace(/\D/g, ''));
        
        return true;
    });
});
</script>
<?php echo $this->endSection(); ?>