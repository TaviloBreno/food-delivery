<?php

namespace App\Validation;

use App\Models\UsuarioModel;

class CustomRules
{
    public function valid_cpf(string $str, string &$error = null): bool
    {
        $model = new UsuarioModel();
        return $model->validaCpf($str, $error);
    }
}
