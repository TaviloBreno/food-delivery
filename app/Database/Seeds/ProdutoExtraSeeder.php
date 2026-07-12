<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdutoExtraSeeder extends Seeder
{
    public function run()
    {
        $extras = [
            // Pizza Margherita (id 1)
            [
                'produto_id' => 1,
                'nome' => 'Mussarela Extra',
                'preco' => 5.00,
            ],
            [
                'produto_id' => 1,
                'nome' => 'Bacon',
                'preco' => 6.00,
            ],
            [
                'produto_id' => 1,
                'nome' => 'Pepperoni',
                'preco' => 7.00,
            ],
            // Pizza Pepperoni (id 2)
            [
                'produto_id' => 2,
                'nome' => 'Mussarela Extra',
                'preco' => 5.00,
            ],
            [
                'produto_id' => 2,
                'nome' => 'Calabresa',
                'preco' => 6.00,
            ],
            // Hambúrguer Clássico (id 4)
            [
                'produto_id' => 4,
                'nome' => 'Bacon',
                'preco' => 5.00,
            ],
            [
                'produto_id' => 4,
                'nome' => 'Queijo Extra',
                'preco' => 4.00,
            ],
            [
                'produto_id' => 4,
                'nome' => 'Ovo',
                'preco' => 3.00,
            ],
            // Hambúrguer Duplo (id 5)
            [
                'produto_id' => 5,
                'nome' => 'Bacon',
                'preco' => 5.00,
            ],
            [
                'produto_id' => 5,
                'nome' => 'Queijo Extra',
                'preco' => 4.00,
            ],
            // Sushi Combo (id 6)
            [
                'produto_id' => 6,
                'nome' => 'Salmão Extra',
                'preco' => 8.00,
            ],
            [
                'produto_id' => 6,
                'nome' => 'Cream Cheese',
                'preco' => 4.00,
            ],
            // Lasanha (id 8)
            [
                'produto_id' => 8,
                'nome' => 'Carne Extra',
                'preco' => 6.00,
            ],
            [
                'produto_id' => 8,
                'nome' => 'Queijo Extra',
                'preco' => 5.00,
            ],
            // Salada Caesar (id 10)
            [
                'produto_id' => 10,
                'nome' => 'Frango Grelhado',
                'preco' => 6.00,
            ],
            [
                'produto_id' => 10,
                'nome' => 'Queijo Parmesão',
                'preco' => 3.00,
            ],
            // Brownie com Sorvete (id 11)
            [
                'produto_id' => 11,
                'nome' => 'Calda de Chocolate',
                'preco' => 3.00,
            ],
            [
                'produto_id' => 11,
                'nome' => 'Sorvete Extra',
                'preco' => 4.00,
            ],
            // Burrito (id 15)
            [
                'produto_id' => 15,
                'nome' => 'Guacamole Extra',
                'preco' => 5.00,
            ],
            [
                'produto_id' => 15,
                'nome' => 'Sour Cream',
                'preco' => 4.00,
            ],
            // Camarão na Manteiga (id 17)
            [
                'produto_id' => 17,
                'nome' => 'Camarão Extra',
                'preco' => 8.00,
            ],
            [
                'produto_id' => 17,
                'nome' => 'Arroz',
                'preco' => 4.00,
            ],
            // Café da Manhã (id 19)
            [
                'produto_id' => 19,
                'nome' => 'Pão de Queijo Extra',
                'preco' => 4.00,
            ],
            [
                'produto_id' => 19,
                'nome' => 'Suco Extra',
                'preco' => 5.00,
            ],
        ];

        foreach ($extras as $extra) {
            $this->db->table('produtos_extras')->insert($extra);
        }

        echo "✅ " . count($extras) . " extras criados com sucesso!\n";
    }
}
