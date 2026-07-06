<?php

/**
 * Formata um CPF para o padrão 000.000.000-00
 *
 * @param string $cpf
 * @return string
 */
function formataCpf(?string $cpf): string
{
    if (empty($cpf)) {
        return '';
    }

    // Remove tudo que não é número
    $cpf = preg_replace('/\D/', '', $cpf);

    // Verifica se tem 11 dígitos
    if (strlen($cpf) !== 11) {
        return $cpf;
    }

    // Aplica a máscara: 000.000.000-00
    return substr($cpf, 0, 3) . '.' .
        substr($cpf, 3, 3) . '.' .
        substr($cpf, 6, 3) . '-' .
        substr($cpf, 9, 2);
}

/**
 * Formata um telefone para o padrão (00) 00000-0000 ou (00) 0000-0000
 *
 * @param string $telefone
 * @return string
 */
function formataTelefone(?string $telefone): string
{
    if (empty($telefone)) {
        return '';
    }

    // Remove tudo que não é número
    $telefone = preg_replace('/\D/', '', $telefone);

    // Verifica se tem 10 ou 11 dígitos
    $length = strlen($telefone);

    if ($length === 10) {
        // Formato: (00) 0000-0000
        return '(' . substr($telefone, 0, 2) . ') ' .
            substr($telefone, 2, 4) . '-' .
            substr($telefone, 6, 4);
    }

    if ($length === 11) {
        // Formato: (00) 00000-0000
        return '(' . substr($telefone, 0, 2) . ') ' .
            substr($telefone, 2, 5) . '-' .
            substr($telefone, 7, 4);
    }

    // Se não tem 10 ou 11 dígitos, retorna sem formatação
    return $telefone;
}

/**
 * Formata um CPF ou Telefone com base no tipo
 *
 * @param string $valor
 * @param string $tipo ('cpf' ou 'telefone')
 * @return string
 */
function formataDocumento(?string $valor, string $tipo = 'cpf'): string
{
    if ($tipo === 'cpf') {
        return formataCpf($valor);
    }

    if ($tipo === 'telefone') {
        return formataTelefone($valor);
    }

    return $valor;
}

/**
 * Remove a máscara de um CPF ou Telefone (apenas números)
 *
 * @param string $valor
 * @return string
 */
function limpaDocumento(?string $valor): string
{
    if (empty($valor)) {
        return '';
    }

    return preg_replace('/\D/', '', $valor);
}
