<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BairroAtendidoSeeder extends Seeder
{
    public function run()
    {
        $bairros = [
            // 🔥 BAIRROS DE CRATEÚS - CE
            [
                'nome' => 'Centro',
                'slug' => 'centro',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 0.00,
                'tempo_medio' => 15,
                'ativo' => 1,
            ],
            [
                'nome' => 'Fátima',
                'slug' => 'fatima',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 2.00,
                'tempo_medio' => 20,
                'ativo' => 1,
            ],
            [
                'nome' => 'Planalto',
                'slug' => 'planalto',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 3.00,
                'tempo_medio' => 25,
                'ativo' => 1,
            ],
            [
                'nome' => 'Venâncios',
                'slug' => 'venancios',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 3.50,
                'tempo_medio' => 25,
                'ativo' => 1,
            ],
            [
                'nome' => 'São José',
                'slug' => 'sao-jose',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 2.50,
                'tempo_medio' => 20,
                'ativo' => 1,
            ],
            [
                'nome' => 'Novo Crateús',
                'slug' => 'novo-crateus',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 4.00,
                'tempo_medio' => 30,
                'ativo' => 1,
            ],
            [
                'nome' => 'Lagoa do Mato',
                'slug' => 'lagoa-do-mato',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 5.00,
                'tempo_medio' => 35,
                'ativo' => 1,
            ],
            [
                'nome' => 'Independência',
                'slug' => 'independencia',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 2.00,
                'tempo_medio' => 20,
                'ativo' => 1,
            ],
            [
                'nome' => 'Alto da Boa Vista',
                'slug' => 'alto-da-boa-vista',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 4.50,
                'tempo_medio' => 30,
                'ativo' => 1,
            ],
            [
                'nome' => 'Boa Esperança',
                'slug' => 'boa-esperanca',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 3.00,
                'tempo_medio' => 25,
                'ativo' => 1,
            ],
            [
                'nome' => 'Santo Antônio',
                'slug' => 'santo-antonio',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 2.50,
                'tempo_medio' => 20,
                'ativo' => 1,
            ],
            [
                'nome' => 'Jardim das Flores',
                'slug' => 'jardim-das-flores',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 4.00,
                'tempo_medio' => 30,
                'ativo' => 1,
            ],
            [
                'nome' => 'Cidade Nova',
                'slug' => 'cidade-nova',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 3.50,
                'tempo_medio' => 25,
                'ativo' => 1,
            ],
            [
                'nome' => 'Santa Luzia',
                'slug' => 'santa-luzia',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 3.00,
                'tempo_medio' => 25,
                'ativo' => 1,
            ],
            [
                'nome' => 'Parque das Águas',
                'slug' => 'parque-das-aguas',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 5.00,
                'tempo_medio' => 35,
                'ativo' => 1,
            ],
            [
                'nome' => 'Vila União',
                'slug' => 'vila-uniao',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 2.00,
                'tempo_medio' => 20,
                'ativo' => 1,
            ],
            [
                'nome' => 'Conjunto Habitacional',
                'slug' => 'conjunto-habitacional',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 4.00,
                'tempo_medio' => 30,
                'ativo' => 1,
            ],
            [
                'nome' => 'Bairro dos Funcionários',
                'slug' => 'bairro-dos-funcionarios',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 2.50,
                'tempo_medio' => 20,
                'ativo' => 1,
            ],
            [
                'nome' => 'Aeroporto',
                'slug' => 'aeroporto',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 5.00,
                'tempo_medio' => 35,
                'ativo' => 1,
            ],
            [
                'nome' => 'Boa Vista',
                'slug' => 'boa-vista',
                'cidade' => 'Crateús',
                'estado' => 'CE',
                'taxa_entrega' => 3.50,
                'tempo_medio' => 25,
                'ativo' => 1,
            ],
        ];

        foreach ($bairros as $bairro) {
            $this->db->table('bairros_atendidos')->insert($bairro);
        }

        echo "✅ " . count($bairros) . " bairros de Crateús-CE criados com sucesso!\n";
    }
}
