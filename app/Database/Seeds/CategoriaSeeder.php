<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            [
                'nome' => 'Pizzas',
                'slug' => 'pizzas',
                'descricao' => 'As melhores pizzas artesanais da cidade, com massa fina e ingredientes selecionados.',
                'icone' => 'mdi-pizza',
                'ativo' => 1,
            ],
            [
                'nome' => 'Hambúrgueres',
                'slug' => 'hamburgueres',
                'descricao' => 'Hambúrgueres artesanais com carnes selecionadas e pães fresquinhos.',
                'icone' => 'mdi-hamburger',
                'ativo' => 1,
            ],
            [
                'nome' => 'Comida Japonesa',
                'slug' => 'comida-japonesa',
                'descricao' => 'Sushis, sashimis e temakis preparados por chefs especializados.',
                'icone' => 'mdi-fish',
                'ativo' => 1,
            ],
            [
                'nome' => 'Massas',
                'slug' => 'massas',
                'descricao' => 'Massas frescas feitas diariamente com receitas tradicionais italianas.',
                'icone' => 'mdi-spaghetti',
                'ativo' => 1,
            ],
            [
                'nome' => 'Saladas',
                'slug' => 'saladas',
                'descricao' => 'Saladas frescas e nutritivas com ingredientes orgânicos.',
                'icone' => 'mdi-leaf',
                'ativo' => 1,
            ],
            [
                'nome' => 'Sobremesas',
                'slug' => 'sobremesas',
                'descricao' => 'Doces e sobremesas para adoçar seu dia com muito sabor.',
                'icone' => 'mdi-cake',
                'ativo' => 1,
            ],
            [
                'nome' => 'Bebidas',
                'slug' => 'bebidas',
                'descricao' => 'Refrigerantes, sucos naturais e bebidas especiais.',
                'icone' => 'mdi-drink',
                'ativo' => 1,
            ],
            [
                'nome' => 'Comida Mexicana',
                'slug' => 'comida-mexicana',
                'descricao' => 'Tacos, burritos e nachos com o autêntico sabor mexicano.',
                'icone' => 'mdi-pepper',
                'ativo' => 1,
            ],
            [
                'nome' => 'Frutos do Mar',
                'slug' => 'frutos-do-mar',
                'descricao' => 'Frutos do mar frescos preparados com receitas especiais.',
                'icone' => 'mdi-shrimp',
                'ativo' => 1,
            ],
            [
                'nome' => 'Café da Manhã',
                'slug' => 'cafe-da-manha',
                'descricao' => 'Deliciosas opções para começar o dia com energia.',
                'icone' => 'mdi-coffee',
                'ativo' => 1,
            ],
        ];

        foreach ($categorias as $categoria) {
            $this->db->table('categorias')->insert($categoria);
        }

        echo "✅ " . count($categorias) . " categorias criadas com sucesso!\n";
    }
}
