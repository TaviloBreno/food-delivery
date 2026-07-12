<?php

declare(strict_types=1);

namespace App\Traits;

use CodeIgniter\HTTP\RequestInterface;

trait PaginacaoTrait
{
    protected function getPerPage(RequestInterface $request): int
    {
        $perPage = $request->getGet('perPage') ?? 10;
        $perPage = in_array($perPage, [5, 10, 15]) ? (int) $perPage : 10;
        return $perPage;
    }

    protected function getPage(RequestInterface $request): ?int
    {
        $page = $request->getGet('page');
        return is_numeric($page) ? (int) $page : null;
    }

    protected function getDadosPaginacao(object $pager, int $total): array
    {
        return [
            'pager' => $pager,
            'perPage' => $this->getPerPage($this->request),
            'total' => $total,
        ];
    }
}
