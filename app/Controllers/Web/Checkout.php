<?php

declare(strict_types=1);

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class Checkout extends BaseController
{
    public function index()
    {
        $data = [
            'titulo' => 'Checkout - Food Delivery',
            'usuario_nome' => session('usuario_nome') ?? 'Visitante',
            'isLoggedIn' => session('isLoggedIn') ?? false,
        ];

        return view('Web/checkout/index', $data);
    }
}
