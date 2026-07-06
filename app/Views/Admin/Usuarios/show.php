<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo esc($titulo); ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<!-- Estilos específicos se necessário -->
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body bg-primary pb-0 pt-4">
                <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            <span class="font-weight-bold">Nome: </span>
                            <?php echo esc($usuario->nome); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Email: </span>
                            <?php echo esc($usuario->email); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">CPF: </span>
                            <?php echo esc($usuario->cpf); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Telefone: </span>
                            <?php echo esc($usuario->telefone); ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="card-text">
                            <span class="font-weight-bold">Status: </span>
                            <?php echo($usuario->ativo ? 'Sim' : 'Não'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Perfil: </span>
                            <?php echo esc($usuario->is_admin ? 'Administrador' : 'Usuário'); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Cadastrado em: </span>
                            <?php echo esc(date('d/m/Y H:i', strtotime($usuario->criado_em))); ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Última atualização: </span>
                            <?php echo esc(date('d/m/Y H:i', strtotime($usuario->atualizado_em))); ?>
                        </p>
                        <?php if ($usuario->deletado_em !== null): ?>
                        <p class="card-text text-danger">
                            <span class="font-weight-bold">Deletado em: </span>
                            <?php echo esc(date('d/m/Y H:i', strtotime($usuario->deletado_em))); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a href="<?php echo site_url('admin/usuarios'); ?>" class="btn btn-secondary btn-sm">
                    <i class="mdi mdi-arrow-left"></i> Voltar
                </a>
                <a href="<?php echo site_url('admin/usuarios/editar/' . $usuario->id); ?>" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-pencil"></i> Editar
                </a>
                <?php if ($usuario->deletado_em === null): ?>
                <a href="<?php echo site_url('admin/usuarios/excluir/' . $usuario->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                    <i class="mdi mdi-delete"></i> Excluir
                </a>
                <?php else: ?>
                <a href="<?php echo site_url('admin/usuarios/restaurar/' . $usuario->id); ?>" class="btn btn-warning btn-sm">
                    <i class="mdi mdi-restore"></i> Restaurar
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<!-- Scripts específicos se necessário -->
<?php echo $this->endSection(); ?>