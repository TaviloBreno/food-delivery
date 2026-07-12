<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EntregadorSeeder extends Seeder
{
    public function run()
    {
        // 🔥 LIMPA A TABELA ANTES DE INSERIR
        $this->db->table('entregadores')->truncate();

        $entregadores = [
            [
                'nome' => 'Carlos Alberto Silva',
                'email' => 'carlos.entregador@email.com',
                'cpf' => '12345678901',
                'telefone' => '11988887777',
                'cnh' => '12345678901',
                'placa_veiculo' => 'ABC-1234',
                'modelo_veiculo' => 'Honda CG 150',
                'cor_veiculo' => 'Vermelha',
                'foto' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&h=200&fit=crop&crop=center',
                'ativo' => 1,
                'disponivel' => 1,
            ],
            [
                'nome' => 'Maria Aparecida Santos',
                'email' => 'maria.entregadora@email.com',
                'cpf' => '98765432100',
                'telefone' => '21977776666',
                'cnh' => '98765432100',
                'placa_veiculo' => 'DEF-5678',
                'modelo_veiculo' => 'Yamaha Fazer 250',
                'cor_veiculo' => 'Azul',
                'foto' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&h=200&fit=crop&crop=center',
                'ativo' => 1,
                'disponivel' => 1,
            ],
            [
                'nome' => 'José Roberto Lima',
                'email' => 'jose.entregador@email.com',
                'cpf' => '55544433322',
                'telefone' => '31955556666',
                'cnh' => '55544433322',
                'placa_veiculo' => 'GHI-9012',
                'modelo_veiculo' => 'Fiat Uno',
                'cor_veiculo' => 'Branco',
                'foto' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=center',
                'ativo' => 1,
                'disponivel' => 1,
            ],
            [
                'nome' => 'Ana Paula Costa',
                'email' => 'ana.entregadora@email.com',
                'cpf' => '11122233344',
                'telefone' => '11999998888',
                'cnh' => '11122233344',
                'placa_veiculo' => 'JKL-3456',
                'modelo_veiculo' => 'Honda Pop 100',
                'cor_veiculo' => 'Prata',
                'foto' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=200&h=200&fit=crop&crop=center',
                'ativo' => 1,
                'disponivel' => 0,
            ],
            [
                'nome' => 'Paulo Henrique Souza',
                'email' => 'paulo.entregador@email.com',
                'cpf' => '77788899900',
                'telefone' => '11955554444',
                'cnh' => '77788899900',
                'placa_veiculo' => 'MNO-7890',
                'modelo_veiculo' => 'Honda XRE 300',
                'cor_veiculo' => 'Laranja',
                'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&h=200&fit=crop&crop=center',
                'ativo' => 1,
                'disponivel' => 1,
            ],
            [
                'nome' => 'Fernanda Lima Oliveira',
                'email' => 'fernanda.entregadora@email.com',
                'cpf' => '33344455566',
                'telefone' => '21933332222',
                'cnh' => '33344455566',
                'placa_veiculo' => 'PQR-1234',
                'modelo_veiculo' => 'Yamaha Nmax 160',
                'cor_veiculo' => 'Preto',
                'foto' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=200&h=200&fit=crop&crop=center',
                'ativo' => 1,
                'disponivel' => 0,
            ],
        ];

        foreach ($entregadores as $entregador) {
            $this->db->table('entregadores')->insert($entregador);
        }

        echo "✅ " . count($entregadores) . " entregadores criados com sucesso!\n";
    }
}
