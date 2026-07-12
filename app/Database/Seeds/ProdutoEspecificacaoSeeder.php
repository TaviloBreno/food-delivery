<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdutoEspecificacaoSeeder extends Seeder
{
    public function run()
    {
        $especificacoes = [
            // Pizza Margherita (id 1)
            [
                'produto_id' => 1,
                'nome' => 'Tamanho',
                'valor' => 'Média (30cm)',
            ],
            [
                'produto_id' => 1,
                'nome' => 'Massa',
                'valor' => 'Fina',
            ],
            [
                'produto_id' => 1,
                'nome' => 'Calorias',
                'valor' => '850 kcal',
            ],
            // Pizza Pepperoni (id 2)
            [
                'produto_id' => 2,
                'nome' => 'Tamanho',
                'valor' => 'Média (30cm)',
            ],
            [
                'produto_id' => 2,
                'nome' => 'Massa',
                'valor' => 'Tradicional',
            ],
            // Pizza Quatro Queijos (id 3)
            [
                'produto_id' => 3,
                'nome' => 'Tamanho',
                'valor' => 'Grande (35cm)',
            ],
            [
                'produto_id' => 3,
                'nome' => 'Massa',
                'valor' => 'Fina',
            ],
            // Hambúrguer Clássico (id 4)
            [
                'produto_id' => 4,
                'nome' => 'Tamanho',
                'valor' => '180g',
            ],
            [
                'produto_id' => 4,
                'nome' => 'Pão',
                'valor' => 'Brioche',
            ],
            [
                'produto_id' => 4,
                'nome' => 'Calorias',
                'valor' => '620 kcal',
            ],
            // Sushi Combo (id 6)
            [
                'produto_id' => 6,
                'nome' => 'Quantidade',
                'valor' => '20 peças',
            ],
            [
                'produto_id' => 6,
                'nome' => 'Variedades',
                'valor' => 'Salmão, Atum, Camarão',
            ],
            // Lasanha (id 8)
            [
                'produto_id' => 8,
                'nome' => 'Tamanho',
                'valor' => 'Individual',
            ],
            [
                'produto_id' => 8,
                'nome' => 'Calorias',
                'valor' => '720 kcal',
            ],
            // Burrito (id 15)
            [
                'produto_id' => 15,
                'nome' => 'Tamanho',
                'valor' => 'Grande',
            ],
            [
                'produto_id' => 15,
                'nome' => 'Pimenta',
                'valor' => 'Suave',
            ],
            // Camarão na Manteiga (id 17)
            [
                'produto_id' => 17,
                'nome' => 'Quantidade',
                'valor' => '10 camarões',
            ],
            [
                'produto_id' => 17,
                'nome' => 'Acompanhamento',
                'valor' => 'Arroz e legumes',
            ],
            // Café da Manhã (id 19)
            [
                'produto_id' => 19,
                'nome' => 'Tamanho',
                'valor' => 'Completo',
            ],
            [
                'produto_id' => 19,
                'nome' => 'Calorias',
                'valor' => '450 kcal',
            ],
        ];

        foreach ($especificacoes as $especificacao) {
            $this->db->table('produtos_especificacoes')->insert($especificacao);
        }

        echo "✅ " . count($especificacoes) . " especificações criadas com sucesso!\n";
    }
}
