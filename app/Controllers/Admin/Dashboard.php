<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Interfaces\DashboardServiceInterface;
use Config\Services;

class Dashboard extends BaseController
{
    private DashboardServiceInterface $dashboardService;

    public function __construct()
    {
        $this->dashboardService = Services::dashboardService();
    }

    public function index()
    {
        $dto = $this->dashboardService->getDados();
        $data = $dto->toArray();

        return view('Admin/Dashboard/index', $data);
    }
}
