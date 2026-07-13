<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaPermissoesEPerfis extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'modulo' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'criado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'atualizado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('permissoes');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'criado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'atualizado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deletado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('perfis');

        $this->forge->addField([
            'perfil_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'permissao_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey(['perfil_id', 'permissao_id']);
        $this->forge->addForeignKey('perfil_id', 'perfis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('permissao_id', 'permissoes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('perfil_permissoes');

        $this->forge->addField([
            'usuario_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'perfil_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey(['usuario_id', 'perfil_id']);
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('perfil_id', 'perfis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('usuario_perfis');

        $this->forge->addColumn('usuarios', [
            'perfil_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
                'default' => null,
            ],
        ], 'is_admin');

        $this->db->query('ALTER TABLE usuarios ADD CONSTRAINT usuarios_perfil_id_foreign FOREIGN KEY (perfil_id) REFERENCES perfis(id) ON DELETE SET NULL');

        $this->inserirPermissoesEPerfisPadrao();
    }

    public function down()
    {
        $this->db->query('ALTER TABLE usuarios DROP FOREIGN KEY usuarios_perfil_id_foreign');
        $this->forge->dropColumn('usuarios', 'perfil_id');
        $this->forge->dropTable('usuario_perfis');
        $this->forge->dropTable('perfil_permissoes');
        $this->forge->dropTable('perfis');
        $this->forge->dropTable('permissoes');
    }

    private function inserirPermissoesEPerfisPadrao(): void
    {
        $permissoes = [
            ['nome' => 'Dashboard', 'slug' => 'dashboard_ver', 'descricao' => 'Visualizar o dashboard administrativo', 'modulo' => 'dashboard'],
            ['nome' => 'Usuários', 'slug' => 'usuarios_ver', 'descricao' => 'Visualizar usuários', 'modulo' => 'usuarios'],
            ['nome' => 'Gerenciar Usuários', 'slug' => 'usuarios_gerenciar', 'descricao' => 'Criar, editar e remover usuários', 'modulo' => 'usuarios'],
            ['nome' => 'Categorias', 'slug' => 'categorias_ver', 'descricao' => 'Visualizar categorias', 'modulo' => 'categorias'],
            ['nome' => 'Gerenciar Categorias', 'slug' => 'categorias_gerenciar', 'descricao' => 'Criar, editar e remover categorias', 'modulo' => 'categorias'],
            ['nome' => 'Produtos', 'slug' => 'produtos_ver', 'descricao' => 'Visualizar produtos', 'modulo' => 'produtos'],
            ['nome' => 'Gerenciar Produtos', 'slug' => 'produtos_gerenciar', 'descricao' => 'Criar, editar e remover produtos', 'modulo' => 'produtos'],
            ['nome' => 'Formas de Pagamento', 'slug' => 'formas_pagamento_ver', 'descricao' => 'Visualizar formas de pagamento', 'modulo' => 'formas_pagamento'],
            ['nome' => 'Gerenciar Formas de Pagamento', 'slug' => 'formas_pagamento_gerenciar', 'descricao' => 'Criar, editar e remover formas de pagamento', 'modulo' => 'formas_pagamento'],
            ['nome' => 'Entregadores', 'slug' => 'entregadores_ver', 'descricao' => 'Visualizar entregadores', 'modulo' => 'entregadores'],
            ['nome' => 'Gerenciar Entregadores', 'slug' => 'entregadores_gerenciar', 'descricao' => 'Criar, editar e remover entregadores', 'modulo' => 'entregadores'],
            ['nome' => 'Bairros Atendidos', 'slug' => 'bairros_ver', 'descricao' => 'Visualizar bairros atendidos', 'modulo' => 'bairros_atendidos'],
            ['nome' => 'Gerenciar Bairros', 'slug' => 'bairros_gerenciar', 'descricao' => 'Criar, editar e remover bairros atendidos', 'modulo' => 'bairros_atendidos'],
            ['nome' => 'Expediente', 'slug' => 'expedientes_ver', 'descricao' => 'Visualizar e editar expediente', 'modulo' => 'expedientes'],
            ['nome' => 'Relatórios', 'slug' => 'relatorios_ver', 'descricao' => 'Visualizar relatórios', 'modulo' => 'relatorios'],
            ['nome' => 'Configurações', 'slug' => 'configuracoes_ver', 'descricao' => 'Visualizar configurações', 'modulo' => 'configuracoes'],
            ['nome' => 'Gerenciar Configurações', 'slug' => 'configuracoes_gerenciar', 'descricao' => 'Editar configurações', 'modulo' => 'configuracoes'],
            ['nome' => 'Pedidos', 'slug' => 'pedidos_ver', 'descricao' => 'Visualizar pedidos', 'modulo' => 'pedidos'],
            ['nome' => 'Gerenciar Pedidos', 'slug' => 'pedidos_gerenciar', 'descricao' => 'Atualizar pedidos', 'modulo' => 'pedidos'],
            ['nome' => 'Clientes', 'slug' => 'clientes_ver', 'descricao' => 'Visualizar clientes', 'modulo' => 'clientes'],
            ['nome' => 'Gerenciar Clientes', 'slug' => 'clientes_gerenciar', 'descricao' => 'Gerenciar clientes', 'modulo' => 'clientes'],
            ['nome' => 'Perfil', 'slug' => 'perfil_ver', 'descricao' => 'Visualizar o próprio perfil', 'modulo' => 'perfil'],
            ['nome' => 'Editar Perfil', 'slug' => 'perfil_gerenciar', 'descricao' => 'Editar o próprio perfil', 'modulo' => 'perfil'],
        ];

        if ($this->db->table('permissoes')->countAllResults() === 0) {
            $this->db->table('permissoes')->insertBatch($permissoes);
        }

        $perfis = [
            ['nome' => 'Administrador', 'slug' => 'admin', 'descricao' => 'Acesso total ao painel administrativo'],
            ['nome' => 'Funcionário', 'slug' => 'funcionario', 'descricao' => 'Acesso operacional limitado'],
            ['nome' => 'Cliente', 'slug' => 'cliente', 'descricao' => 'Acesso apenas ao perfil do cliente'],
        ];

        if ($this->db->table('perfis')->countAllResults() === 0) {
            $this->db->table('perfis')->insertBatch($perfis);
        }

        $permissoesPorPerfil = [
            'admin' => [
                'dashboard_ver',
                'usuarios_ver',
                'usuarios_gerenciar',
                'categorias_ver',
                'categorias_gerenciar',
                'produtos_ver',
                'produtos_gerenciar',
                'formas_pagamento_ver',
                'formas_pagamento_gerenciar',
                'entregadores_ver',
                'entregadores_gerenciar',
                'bairros_ver',
                'bairros_gerenciar',
                'expedientes_ver',
                'relatorios_ver',
                'configuracoes_ver',
                'configuracoes_gerenciar',
                'pedidos_ver',
                'pedidos_gerenciar',
                'clientes_ver',
                'clientes_gerenciar',
                'perfil_ver',
                'perfil_gerenciar'
            ],
            'funcionario' => [
                'dashboard_ver',
                'categorias_ver',
                'produtos_ver',
                'produtos_gerenciar',
                'pedidos_ver',
                'pedidos_gerenciar',
                'perfil_ver',
                'perfil_gerenciar'
            ],
            'cliente' => [
                'produtos_ver',
                'categorias_ver',
                'pedidos_ver',
                'pedidos_gerenciar',
                'perfil_ver',
                'perfil_gerenciar'
            ],
        ];

        $perfisLista = $this->db->table('perfis')->get()->getResultArray();
        $permissoesLista = $this->db->table('permissoes')->get()->getResultArray();

        $permissaoIds = [];
        foreach ($permissoesLista as $permissao) {
            $permissaoIds[$permissao['slug']] = (int) $permissao['id'];
        }

        $this->db->table('perfil_permissoes')->truncate();
        foreach ($perfisLista as $perfil) {
            $slugs = $permissoesPorPerfil[$perfil['slug']] ?? [];
            $linhas = [];
            foreach ($slugs as $slug) {
                if (isset($permissaoIds[$slug])) {
                    $linhas[] = [
                        'perfil_id' => (int) $perfil['id'],
                        'permissao_id' => $permissaoIds[$slug],
                    ];
                }
            }

            if (!empty($linhas)) {
                $this->db->table('perfil_permissoes')->insertBatch($linhas);
            }
        }

        $adminPerfilId = (int) $this->db->table('perfis')->where('slug', 'admin')->get()->getRow()->id;
        $clientePerfilId = (int) $this->db->table('perfis')->where('slug', 'cliente')->get()->getRow()->id;

        $this->db->table('usuarios')->set('perfil_id', $adminPerfilId)->where('is_admin', 1)->update();
        $this->db->table('usuarios')->set('perfil_id', $clientePerfilId)->where('is_admin', 0)->where('perfil_id IS NULL', null, false)->update();

        $usuarios = $this->db->table('usuarios')->select('id, perfil_id, is_admin')->get()->getResultArray();
        $rows = [];
        foreach ($usuarios as $usuario) {
            $perfilId = !empty($usuario['perfil_id']) ? (int) $usuario['perfil_id'] : ((int) $usuario['is_admin'] === 1 ? $adminPerfilId : $clientePerfilId);
            $rows[] = [
                'usuario_id' => (int) $usuario['id'],
                'perfil_id' => $perfilId,
            ];
        }

        if (!empty($rows)) {
            $this->db->table('usuario_perfis')->truncate();
            $this->db->table('usuario_perfis')->insertBatch($rows);
        }
    }
}
