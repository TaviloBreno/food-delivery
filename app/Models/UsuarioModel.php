<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';
    protected $allowedFields    = [
        'nome',
        'email',
        'cpf',
        'telefone',
        'password_hash',
        'ativo',
        'is_admin',
        'deletado_em',
        'reset_hash',
        'reset_expira_em',
    ];

    protected $useSoftDelete    = true;

    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em';
    protected $updatedField     = 'atualizado_em';
    protected $deletedField     = 'deletado_em';
    protected $dateFormat       = 'datetime';

    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[120]',
        'email' => 'required|valid_email|is_unique[usuarios.email,id,{id}]',
        'cpf' => 'required|exact_length[11]|is_unique[usuarios.cpf,id,{id}]|valid_cpf',
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
            'valid_cpf' => 'CPF inválido. Verifique se os números estão corretos.',
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

    public function validaCpf(string $cpf, string &$error = null): bool
    {
        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);

        if (
            strlen($cpf) != 11 ||
            $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' ||
            $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' ||
            $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' ||
            $cpf == '99999999999'
        ) {
            $error = 'Por favor digite um CPF válido';
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $error = 'Por favor digite um CPF válido';
                return false;
            }
        }

        return true;
    }

    public function softDelete(int $id): bool
    {
        return $this->update($id, ['deletado_em' => date('Y-m-d H:i:s')]);
    }

    public function softRestore(int $id): bool
    {
        return $this->update($id, ['deletado_em' => null]);
    }

    public function isAdmin(int $id): bool
    {
        $usuario = $this->find($id);
        return $usuario && $usuario->is_admin == 1;
    }

    /**
     * Undocumented function
     *
     * @param string $email
     * @return object
     */
    public function buscaUsuarioPorEmail(string $email): object
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Gera um token de reset de senha
     *
     * @param string $email
     * @return string|null
     */
    public function gerarTokenReset(string $email): ?string
    {
        $usuario = $this->where('email', $email)->first();

        if (!$usuario) {
            return null;
        }

        $token = bin2hex(random_bytes(32));
        $expiraEm = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->update($usuario->id, [
            'reset_hash' => $token,
            'reset_expira_em' => $expiraEm,
        ]);

        return $token;
    }

    /**
     * Valida o token de reset
     *
     * @param string $token
     * @return object|null
     */
    public function validarTokenReset(string $token): ?object
    {
        $usuario = $this->where('reset_hash', $token)
            ->where('reset_expira_em >=', date('Y-m-d H:i:s'))
            ->first();

        return $usuario;
    }

    /**
     * Redefine a senha do usuário
     *
     * @param string $token
     * @param string $novaSenha
     * @return bool
     */
    public function redefinirSenha(string $token, string $novaSenha): bool
    {
        $usuario = $this->validarTokenReset($token);

        if (!$usuario) {
            return false;
        }

        $this->update($usuario->id, [
            'password_hash' => password_hash($novaSenha, PASSWORD_DEFAULT),
            'reset_hash' => null,
            'reset_expira_em' => null,
        ]);

        return true;
    }

    /**
     * Verifica se o token é válido e não expirou
     *
     * @param string $token
     * @return bool
     */
    public function tokenValido(string $token): bool
    {
        return $this->where('reset_hash', $token)
            ->where('reset_expira_em >=', date('Y-m-d H:i:s'))
            ->first() !== null;
    }

    /**
     * Busca usuário pelo token de reset
     *
     * @param string $token
     * @return object|null
     */
    public function buscaPorTokenReset(string $token): ?object
    {
        return $this->where('reset_hash', $token)->first();
    }
}
