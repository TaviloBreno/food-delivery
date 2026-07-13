<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ConfiguracaoModel;
use App\Interfaces\ConfiguracaoRepositoryInterface;

class ConfiguracaoRepository implements ConfiguracaoRepositoryInterface
{
    private ConfiguracaoModel $model;

    public function __construct()
    {
        $this->model = new ConfiguracaoModel();
    }

    public function getDadosSite(): object
    {
        $config = $this->model->first();

        if (!$config) {
            // Retorna dados padrão se não encontrar
            return (object) [
                'id' => 1,
                'cidade' => 'Sua Cidade',
                'endereco' => 'Seu Endereço',
                'telefone' => '(00) 0000-0000',
                'horario_funcionamento' => '11:00 - 23:00',
                'sobre' => 'Food Delivery - A melhor opção para pedir comida online.',
                'sobre_extra' => 'Trabalhamos com ingredientes frescos e selecionados.',
                'sobre_footer' => 'Entregamos sabor e qualidade diretamente na sua casa.',
                'endereco_completo' => 'Av. Paulista, 1000 - São Paulo - SP',
                'email' => 'contato@fooddelivery.com',
                'whatsapp' => '(00) 00000-0000',
                'google_maps_api_key' => 'AIzaSyBcg5Y2D1fpGI12T8wcbtPIsyGdw-_NV1Y'
            ];
        }

        return $config;
    }

    public function getHorariosFuncionamento(): array
    {
        $horarios = $this->model->where('chave', 'horarios_funcionamento')->first();

        if ($horarios && isset($horarios->valor)) {
            return json_decode($horarios->valor, true);
        }

        return [
            'Segunda' => ['fechado' => true],
            'Terça' => ['fechado' => false, 'abertura' => '10:00', 'fechamento' => '22:00'],
            'Quarta' => ['fechado' => false, 'abertura' => '10:00', 'fechamento' => '22:00'],
            'Quinta' => ['fechado' => false, 'abertura' => '10:00', 'fechamento' => '22:00'],
            'Sexta' => ['fechado' => false, 'abertura' => '10:00', 'fechamento' => '23:00'],
            'Sábado' => ['fechado' => false, 'abertura' => '11:00', 'fechamento' => '23:00'],
            'Domingo' => ['fechado' => false, 'abertura' => '11:00', 'fechamento' => '20:00']
        ];
    }

    public function getRedesSociais(): array
    {
        $redes = $this->model->where('chave', 'redes_sociais')->first();

        if ($redes && isset($redes->valor)) {
            return json_decode($redes->valor, true);
        }

        return [
            ['nome' => 'Facebook', 'icone' => 'facebook', 'url' => '#'],
            ['nome' => 'Instagram', 'icone' => 'instagram', 'url' => '#'],
            ['nome' => 'WhatsApp', 'icone' => 'whatsapp', 'url' => '#']
        ];
    }
}
