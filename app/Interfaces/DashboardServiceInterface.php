<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\DashboardDTO;

interface DashboardServiceInterface
{
    public function getDados(): DashboardDTO;
}
