<?php echo $this->extend('Admin/layout/principal'); ?>

<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link rel="stylesheet" href="<?php echo site_url('admin/css/usuarios.css'); ?>">
<style>
    .table-expediente td {
        vertical-align: middle !important;
        padding: 8px 10px !important;
    }

    .table-expediente .form-control {
        padding: 4px 8px !important;
        font-size: 13px !important;
        height: 32px !important;
    }

    .table-expediente .status-checkbox {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
    }

    .table-expediente .status-checkbox .form-check-input {
        width: 18px !important;
        height: 18px !important;
        cursor: pointer !important;
        margin: 0 !important;
        position: relative !important;
        top: 0 !important;
    }

    .table-expediente .status-checkbox .form-check-label {
        margin: 0 !important;
        cursor: pointer !important;
        font-size: 13px !important;
        color: #495057 !important;
    }

    .table-expediente .status-checkbox .form-check-label.fechado {
        color: #dc3545 !important;
        font-weight: 600 !important;
    }

    .table-expediente .status-checkbox .form-check-label.aberto {
        color: #28a745 !important;
        font-weight: 600 !important;
    }

    .table-expediente thead th {
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        font-weight: 600 !important;
        color: #495057 !important;
    }

    .table-expediente .badge-status {
        font-size: 12px !important;
        padding: 4px 12px !important;
        border-radius: 12px !important;
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0"><?php echo $titulo; ?></h4>
                </div>

                <form action="<?php echo site_url('admin/expedientes/salvar'); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="table-responsive">
                        <table class="table table-hover table-expediente">
                            <thead>
                                <tr>
                                    <th>Dia da semana</th>
                                    <th class="text-center">Status</th>
                                    <th>Abertura</th>
                                    <th>Fechamento</th>
                                    <th>Intervalo início</th>
                                    <th>Intervalo fim</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dias as $key => $nome): ?>
                                    <?php $expediente = $expedientes[$key]; ?>
                                    <?php $isFechado = isset($expediente->fechado) && $expediente->fechado == 1; ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo $nome; ?></strong>
                                        </td>
                                        <td class="text-center">
                                            <div class="status-checkbox">
                                                <input type="checkbox"
                                                    class="form-check-input"
                                                    id="fechado_<?php echo $key; ?>"
                                                    name="fechado_<?php echo $key; ?>"
                                                    value="1"
                                                    <?php echo $isFechado ? 'checked' : ''; ?>
                                                    onchange="toggleHorarios('<?php echo $key; ?>')">
                                                <label class="form-check-label <?php echo $isFechado ? 'fechado' : 'aberto'; ?>"
                                                    for="fechado_<?php echo $key; ?>"
                                                    id="label_<?php echo $key; ?>">
                                                    <?php echo $isFechado ? '🔴 Fechado' : '✅ Aberto'; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="time"
                                                class="form-control"
                                                id="abertura_<?php echo $key; ?>"
                                                name="abertura_<?php echo $key; ?>"
                                                value="<?php echo $expediente->abertura ?? ''; ?>"
                                                <?php echo $isFechado ? 'disabled' : ''; ?>>
                                        </td>
                                        <td>
                                            <input type="time"
                                                class="form-control"
                                                id="fechamento_<?php echo $key; ?>"
                                                name="fechamento_<?php echo $key; ?>"
                                                value="<?php echo $expediente->fechamento ?? ''; ?>"
                                                <?php echo $isFechado ? 'disabled' : ''; ?>>
                                        </td>
                                        <td>
                                            <input type="time"
                                                class="form-control"
                                                id="intervalo_inicio_<?php echo $key; ?>"
                                                name="intervalo_inicio_<?php echo $key; ?>"
                                                value="<?php echo $expediente->intervalo_inicio ?? ''; ?>"
                                                <?php echo $isFechado ? 'disabled' : ''; ?>>
                                        </td>
                                        <td>
                                            <input type="time"
                                                class="form-control"
                                                id="intervalo_fim_<?php echo $key; ?>"
                                                name="intervalo_fim_<?php echo $key; ?>"
                                                value="<?php echo $expediente->intervalo_fim ?? ''; ?>"
                                                <?php echo $isFechado ? 'disabled' : ''; ?>>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i> Salvar expediente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    function toggleHorarios(dia) {
        var fechado = document.getElementById('fechado_' + dia).checked;
        var abertura = document.getElementById('abertura_' + dia);
        var fechamento = document.getElementById('fechamento_' + dia);
        var intervaloInicio = document.getElementById('intervalo_inicio_' + dia);
        var intervaloFim = document.getElementById('intervalo_fim_' + dia);
        var label = document.getElementById('label_' + dia);

        abertura.disabled = fechado;
        fechamento.disabled = fechado;
        intervaloInicio.disabled = fechado;
        intervaloFim.disabled = fechado;

        if (fechado) {
            abertura.value = '';
            fechamento.value = '';
            intervaloInicio.value = '';
            intervaloFim.value = '';
            label.textContent = '🔴 Fechado';
            label.className = 'form-check-label fechado';
        } else {
            label.textContent = '✅ Aberto';
            label.className = 'form-check-label aberto';
        }
    }
</script>
<?php echo $this->endSection(); ?>