<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExpedienteModel;
use CodeIgniter\HTTP\RedirectResponse;

class Expedientes extends BaseController
{
    private ExpedienteModel $expedienteModel;

    public function __construct()
    {
        $this->expedienteModel = new ExpedienteModel();
    }

    public function index()
    {
        $dias = $this->expedienteModel->getDiasSemana();
        $expedientes = [];

        foreach ($dias as $key => $nome) {
            $expediente = $this->expedienteModel->where('dia_semana', $key)->first();

            if (!$expediente) {
                $expediente = $this->expedienteModel->criarPadrao($key);
            }

            $expedientes[$key] = $expediente;
        }

        $data = [
            'titulo' => 'Gerenciar expediente',
            'expedientes' => $expedientes,
            'dias' => $dias,
        ];

        return view('Admin/Expedientes/index', $data);
    }

    public function salvar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $dias = $this->expedienteModel->getDiasSemana();

        foreach ($dias as $key => $nome) {
            $fechado = isset($post['fechado_' . $key]) ? 1 : 0;

            $dados = [
                'dia_semana' => $key,
                'abertura' => !$fechado ? $post['abertura_' . $key] : null,
                'fechamento' => !$fechado ? $post['fechamento_' . $key] : null,
                'intervalo_inicio' => !$fechado && !empty($post['intervalo_inicio_' . $key]) ? $post['intervalo_inicio_' . $key] : null,
                'intervalo_fim' => !$fechado && !empty($post['intervalo_fim_' . $key]) ? $post['intervalo_fim_' . $key] : null,
                'fechado' => $fechado,
            ];

            $existe = $this->expedienteModel->where('dia_semana', $key)->first();

            if ($existe) {
                $this->expedienteModel->update($existe->id, $dados);
            } else {
                $this->expedienteModel->insert($dados);
            }
        }

        return redirect()->to(site_url('admin/expedientes'))->with('sucesso', 'Expediente atualizado com sucesso!');
    }
}
