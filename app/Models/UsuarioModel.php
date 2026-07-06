<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';
    protected $allowedFields    = ['nome', 'email', 'cpf', 'telefone', 'password_hash', 'ativo', 'is_admin'];
    protected $useSoftDelete    = true;
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';
    protected $deletedField     = 'deletado_em';

    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[120]',
        'email' => 'required|valid_email|is_unique[usuarios.email,id,{id}]',
        'cpf' => 'required|exact_length[11]|is_unique[usuarios.cpf,id,{id}]',
        'telefone' => 'required|exact_length[11]|is_unique[usuarios.telefone,id,{id}]',
        'password_hash' => 'permit_empty',
        'ativo' => 'required|in_list[0,1]',
        'is_admin' => 'required|in_list[0,1]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório. Por favor, preencha seu nome completo.',
            'min_length' => 'O Nome deve ter no mínimo 3 caracteres. Digite seu nome completo.',
            'max_length' => 'O Nome deve ter no máximo 120 caracteres. Use um nome mais curto.',
        ],
        'email' => [
            'required' => 'O campo E-mail é obrigatório. Digite um endereço de e-mail válido.',
            'valid_email' => 'Digite um endereço de e-mail válido. Exemplo: seuemail@dominio.com',
            'is_unique' => 'Este e-mail já está cadastrado. Use outro e-mail ou faça login.',
        ],
        'cpf' => [
            'required' => 'O campo CPF é obrigatório. Digite seu CPF com 11 números.',
            'exact_length' => 'O CPF deve ter exatamente 11 números. Exemplo: 12345678901',
            'is_unique' => 'Este CPF já está cadastrado. Se você já tem cadastro, faça login. Se não, verifique se digitou corretamente.',
        ],
        'telefone' => [
            'required' => 'O campo Telefone é obrigatório. Digite seu telefone com DDD.',
            'exact_length' => 'O Telefone deve ter exatamente 11 números (DDD + número). Exemplo: 11988887777',
            'is_unique' => 'Este telefone já está cadastrado. Use outro telefone ou entre em contato com o suporte.',
        ],
        'senha' => [
            'required' => 'A senha é obrigatória. Crie uma senha com pelo menos 8 caracteres.',
            'min_length' => 'A senha deve ter no mínimo 8 caracteres. Use letras, números e caracteres especiais para mais segurança.',
        ],
        'senha_confirmacao' => [
            'required' => 'Confirme sua senha digitando novamente.',
            'matches' => 'As senhas não coincidem. Digite a mesma senha nos dois campos.',
        ],
        'ativo' => [
            'required' => 'Selecione o status do usuário (Ativo ou Inativo).',
            'in_list' => 'Status inválido. Selecione Ativo ou Inativo.',
        ],
        'is_admin' => [
            'required' => 'Selecione a permissão do usuário (Administrador ou Usuário comum).',
            'in_list' => 'Permissão inválida. Selecione Administrador ou Usuário comum.',
        ],
    ];

    public function procurar(string $term): array
    {
        if (empty($term)) {
            return [];
        }

        return $this->select('id, nome')
            ->like('nome', $term)
            ->withDeleted(true)
            ->get()
            ->getResult();
    }

    public function validarSenha(string $senha): bool
    {
        return strlen($senha) >= 8;
    }
}
