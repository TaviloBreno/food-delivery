<?php

declare(strict_types=1);

if (!function_exists('validarCpf')) {
    function validarCpf(string $cpf): bool
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) !== 11) {
            return false;
        }

        $invalidos = [
            '00000000000',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999'
        ];

        if (in_array($cpf, $invalidos)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('limparCpf')) {
    function limparCpf(string $cpf): string
    {
        return preg_replace('/\D/', '', $cpf);
    }
}

if (!function_exists('limparTelefone')) {
    function limparTelefone(string $telefone): string
    {
        return preg_replace('/\D/', '', $telefone);
    }
}
