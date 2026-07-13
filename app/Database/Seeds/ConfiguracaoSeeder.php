<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConfiguracaoSeeder extends Seeder
{
    public function run()
    {
        // Verificar se já existe um registro
        $existing = $this->db->table('configuracoes')
            ->where('id', 1)
            ->get()
            ->getRow();

        if (!$existing) {
            // Inserir configurações principais
            $this->db->table('configuracoes')->insert([
                'id' => 1,
                'cidade' => 'São Paulo',
                'endereco' => 'Av. Paulista, 1000',
                'telefone' => '(11) 99999-9999',
                'horario_funcionamento' => '11:00 - 23:00',
                'sobre' => 'Food Delivery - A melhor opção para pedir comida online. Oferecemos os melhores pratos preparados com ingredientes frescos e selecionados.',
                'sobre_extra' => 'Trabalhamos com os melhores chefs e ingredientes para garantir qualidade e sabor em cada pedido.',
                'sobre_footer' => 'Entregamos sabor e qualidade diretamente na sua casa.',
                'endereco_completo' => 'Av. Paulista, 1000 - São Paulo - SP',
                'email' => 'contato@fooddelivery.com',
                'google_maps_api_key' => 'AIzaSyBcg5Y2D1fpGI12T8wcbtPIsyGdw-_NV1Y',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Verificar se já existe o registro de horários
        $horariosExist = $this->db->table('configuracoes')
            ->where('chave', 'horarios_funcionamento')
            ->get()
            ->getRow();

        if (!$horariosExist) {
            // Inserir horários de funcionamento
            $this->db->table('configuracoes')->insert([
                'chave' => 'horarios_funcionamento',
                'valor' => json_encode([
                    'Segunda' => ['fechado' => true],
                    'Terça' => ['fechado' => false, 'abertura' => '10:00', 'fechamento' => '22:00'],
                    'Quarta' => ['fechado' => false, 'abertura' => '10:00', 'fechamento' => '22:00'],
                    'Quinta' => ['fechado' => false, 'abertura' => '10:00', 'fechamento' => '22:00'],
                    'Sexta' => ['fechado' => false, 'abertura' => '10:00', 'fechamento' => '23:00'],
                    'Sábado' => ['fechado' => false, 'abertura' => '11:00', 'fechamento' => '23:00'],
                    'Domingo' => ['fechado' => false, 'abertura' => '11:00', 'fechamento' => '20:00']
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Verificar se já existe o registro de redes sociais
        $redesExist = $this->db->table('configuracoes')
            ->where('chave', 'redes_sociais')
            ->get()
            ->getRow();

        if (!$redesExist) {
            // Inserir redes sociais
            $this->db->table('configuracoes')->insert([
                'chave' => 'redes_sociais',
                'valor' => json_encode([
                    ['nome' => 'Facebook', 'icone' => 'facebook', 'url' => '#'],
                    ['nome' => 'Instagram', 'icone' => 'instagram', 'url' => '#'],
                    ['nome' => 'WhatsApp', 'icone' => 'whatsapp', 'url' => '#']
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Exibir mensagem de sucesso
        echo "✅ Configurações inseridas com sucesso!\n";
    }
}
