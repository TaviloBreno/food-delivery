<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FormaPagamentoSeeder extends Seeder
{
    public function run()
    {
        $formas = [
            [
                'nome' => 'Cartão de Crédito',
                'slug' => 'cartao-de-credito',
                'icone' => 'mdi-credit-card',
                'descricao' => 'Pagamento com cartão de crédito em até 12x',
                'taxa' => 3.00,
                'parcelas' => 12,
                'ativo' => 1,
            ],
            [
                'nome' => 'Cartão de Débito',
                'slug' => 'cartao-de-debito',
                'icone' => 'mdi-credit-card-outline',
                'descricao' => 'Pagamento com cartão de débito à vista',
                'taxa' => 0.00,
                'parcelas' => 1,
                'ativo' => 1,
            ],
            [
                'nome' => 'PIX',
                'slug' => 'pix',
                'icone' => 'mdi-qrcode',
                'descricao' => 'Pagamento instantâneo via PIX',
                'taxa' => 0.00,
                'parcelas' => 1,
                'ativo' => 1,
            ],
            [
                'nome' => 'Boleto Bancário',
                'slug' => 'boleto-bancario',
                'icone' => 'mdi-barcode',
                'descricao' => 'Pagamento com boleto bancário vencimento em 3 dias',
                'taxa' => 2.00,
                'parcelas' => 1,
                'ativo' => 1,
            ],
            [
                'nome' => 'Dinheiro',
                'slug' => 'dinheiro',
                'icone' => 'mdi-cash',
                'descricao' => 'Pagamento em dinheiro (recebe troco)',
                'taxa' => 0.00,
                'parcelas' => 1,
                'ativo' => 1,
            ],
            [
                'nome' => 'Vale Refeição',
                'slug' => 'vale-refeicao',
                'icone' => 'mdi-food',
                'descricao' => 'Pagamento com vale refeição',
                'taxa' => 1.50,
                'parcelas' => 1,
                'ativo' => 1,
            ],
            [
                'nome' => 'Vale Alimentação',
                'slug' => 'vale-alimentacao',
                'icone' => 'mdi-shopping',
                'descricao' => 'Pagamento com vale alimentação',
                'taxa' => 1.50,
                'parcelas' => 1,
                'ativo' => 1,
            ],
            [
                'nome' => 'Transferência Bancária',
                'slug' => 'transferencia-bancaria',
                'icone' => 'mdi-bank-transfer',
                'descricao' => 'Pagamento via transferência bancária (TED/DOC)',
                'taxa' => 0.00,
                'parcelas' => 1,
                'ativo' => 1,
            ],
        ];

        foreach ($formas as $forma) {
            $this->db->table('formas_pagamento')->insert($forma);
        }

        echo "✅ " . count($formas) . " formas de pagamento criadas com sucesso!\n";
    }
}
