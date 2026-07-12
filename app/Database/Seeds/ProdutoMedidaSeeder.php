<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdutoMedidaSeeder extends Seeder
{
    public function run()
    {
        $medidas = [
            // Pizza Margherita (id 1)
            [
                'produto_id' => 1,
                'nome' => 'Pequena',
                'tamanho' => '25cm',
                'preco' => 29.90,
            ],
            [
                'produto_id' => 1,
                'nome' => 'Média',
                'tamanho' => '30cm',
                'preco' => 39.90,
            ],
            [
                'produto_id' => 1,
                'nome' => 'Grande',
                'tamanho' => '35cm',
                'preco' => 49.90,
            ],
            // Pizza Pepperoni (id 2)
            [
                'produto_id' => 2,
                'nome' => 'Pequena',
                'tamanho' => '25cm',
                'preco' => 32.90,
            ],
            [
                'produto_id' => 2,
                'nome' => 'Média',
                'tamanho' => '30cm',
                'preco' => 42.90,
            ],
            [
                'produto_id' => 2,
                'nome' => 'Grande',
                'tamanho' => '35cm',
                'preco' => 52.90,
            ],
            // Pizza Quatro Queijos (id 3)
            [
                'produto_id' => 3,
                'nome' => 'Pequena',
                'tamanho' => '25cm',
                'preco' => 31.90,
            ],
            [
                'produto_id' => 3,
                'nome' => 'Média',
                'tamanho' => '30cm',
                'preco' => 41.90,
            ],
            [
                'produto_id' => 3,
                'nome' => 'Grande',
                'tamanho' => '35cm',
                'preco' => 51.90,
            ],
            // Hambúrguer Clássico (id 4)
            [
                'produto_id' => 4,
                'nome' => 'Simples',
                'tamanho' => '150g',
                'preco' => 24.90,
            ],
            [
                'produto_id' => 4,
                'nome' => 'Duplo',
                'tamanho' => '300g',
                'preco' => 34.90,
            ],
            // Hambúrguer Duplo (id 5)
            [
                'produto_id' => 5,
                'nome' => 'Simples',
                'tamanho' => '180g',
                'preco' => 28.90,
            ],
            [
                'produto_id' => 5,
                'nome' => 'Duplo',
                'tamanho' => '360g',
                'preco' => 38.90,
            ],
            // Sushi Combo (id 6)
            [
                'produto_id' => 6,
                'nome' => '10 peças',
                'tamanho' => '10 unidades',
                'preco' => 49.90,
            ],
            [
                'produto_id' => 6,
                'nome' => '20 peças',
                'tamanho' => '20 unidades',
                'preco' => 79.90,
            ],
            [
                'produto_id' => 6,
                'nome' => '30 peças',
                'tamanho' => '30 unidades',
                'preco' => 109.90,
            ],
            // Temaki Salmão (id 7)
            [
                'produto_id' => 7,
                'nome' => 'Único',
                'tamanho' => '1 unidade',
                'preco' => 22.90,
            ],
            [
                'produto_id' => 7,
                'nome' => 'Duplo',
                'tamanho' => '2 unidades',
                'preco' => 39.90,
            ],
            // Lasanha (id 8)
            [
                'produto_id' => 8,
                'nome' => 'Individual',
                'tamanho' => '300g',
                'preco' => 29.90,
            ],
            [
                'produto_id' => 8,
                'nome' => 'Família',
                'tamanho' => '600g',
                'preco' => 49.90,
            ],
            // Espaguete Carbonara (id 9)
            [
                'produto_id' => 9,
                'nome' => 'Individual',
                'tamanho' => '250g',
                'preco' => 27.90,
            ],
            [
                'produto_id' => 9,
                'nome' => 'Família',
                'tamanho' => '500g',
                'preco' => 45.90,
            ],
            // Salada Caesar (id 10)
            [
                'produto_id' => 10,
                'nome' => 'Pequena',
                'tamanho' => '200g',
                'preco' => 19.90,
            ],
            [
                'produto_id' => 10,
                'nome' => 'Grande',
                'tamanho' => '400g',
                'preco' => 29.90,
            ],
            // Brownie (id 11)
            [
                'produto_id' => 11,
                'nome' => 'Único',
                'tamanho' => '1 unidade',
                'preco' => 14.90,
            ],
            [
                'produto_id' => 11,
                'nome' => 'Duplo',
                'tamanho' => '2 unidades',
                'preco' => 24.90,
            ],
            // Pudim (id 12)
            [
                'produto_id' => 12,
                'nome' => 'Individual',
                'tamanho' => '1 fatia',
                'preco' => 12.90,
            ],
            [
                'produto_id' => 12,
                'nome' => 'Família',
                'tamanho' => '1 inteiro',
                'preco' => 22.90,
            ],
            // Suco Detox (id 13)
            [
                'produto_id' => 13,
                'nome' => '300ml',
                'tamanho' => '300ml',
                'preco' => 12.90,
            ],
            [
                'produto_id' => 13,
                'nome' => '500ml',
                'tamanho' => '500ml',
                'preco' => 16.90,
            ],
            // Refrigerante (id 14)
            [
                'produto_id' => 14,
                'nome' => 'Lata',
                'tamanho' => '350ml',
                'preco' => 5.90,
            ],
            [
                'produto_id' => 14,
                'nome' => 'Garrafa',
                'tamanho' => '2L',
                'preco' => 9.90,
            ],
            // Burrito (id 15)
            [
                'produto_id' => 15,
                'nome' => 'Pequeno',
                'tamanho' => '250g',
                'preco' => 24.90,
            ],
            [
                'produto_id' => 15,
                'nome' => 'Grande',
                'tamanho' => '450g',
                'preco' => 34.90,
            ],
            // Nachos (id 16)
            [
                'produto_id' => 16,
                'nome' => 'Individual',
                'tamanho' => '150g',
                'preco' => 18.90,
            ],
            [
                'produto_id' => 16,
                'nome' => 'Família',
                'tamanho' => '300g',
                'preco' => 28.90,
            ],
            // Camarão na Manteiga (id 17)
            [
                'produto_id' => 17,
                'nome' => '6 unidades',
                'tamanho' => '6 camarões',
                'preco' => 39.90,
            ],
            [
                'produto_id' => 17,
                'nome' => '12 unidades',
                'tamanho' => '12 camarões',
                'preco' => 59.90,
            ],
            // Salada de Frutos do Mar (id 18)
            [
                'produto_id' => 18,
                'nome' => 'Pequena',
                'tamanho' => '250g',
                'preco' => 34.90,
            ],
            [
                'produto_id' => 18,
                'nome' => 'Grande',
                'tamanho' => '500g',
                'preco' => 49.90,
            ],
            // Café da Manhã (id 19)
            [
                'produto_id' => 19,
                'nome' => 'Individual',
                'tamanho' => '1 pessoa',
                'preco' => 24.90,
            ],
            [
                'produto_id' => 19,
                'nome' => 'Casal',
                'tamanho' => '2 pessoas',
                'preco' => 39.90,
            ],
            // Pão de Queijo (id 20)
            [
                'produto_id' => 20,
                'nome' => '6 unidades',
                'tamanho' => '6 unidades',
                'preco' => 12.90,
            ],
            [
                'produto_id' => 20,
                'nome' => '12 unidades',
                'tamanho' => '12 unidades',
                'preco' => 19.90,
            ],
        ];

        foreach ($medidas as $medida) {
            $this->db->table('produtos_medidas')->insert($medida);
        }

        echo "✅ " . count($medidas) . " medidas criadas com sucesso!\n";
    }
}
