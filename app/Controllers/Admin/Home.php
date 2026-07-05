<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'titulo' => 'Home da área restrita',
        ];

        return view('Admin/Home/index', $data);
    }
}
