<?php

declare(strict_types=1);

namespace App\DTOs;

class DashboardDTO
{
    public function __construct(
        // Usuários
        public readonly int $totalUsuarios,
        public readonly int $totalUsuariosAtivos,
        public readonly int $totalUsuariosInativos,
        public readonly int $totalUsuariosDeletados,
        // Categorias
        public readonly int $totalCategorias,
        public readonly int $totalCategoriasAtivas,
        // Produtos
        public readonly int $totalProdutos,
        public readonly int $totalProdutosAtivos,
        public readonly int $totalProdutosInativos,
        public readonly int $totalProdutosDestaque,
        // Entregadores
        public readonly int $totalEntregadores,
        public readonly int $totalEntregadoresDisponiveis,
        public readonly int $totalEntregadoresOcupados,
        // Bairros
        public readonly int $totalBairros,
        public readonly int $totalBairrosAtivos,
        // Formas de Pagamento
        public readonly int $totalFormasPagamento,
        public readonly int $totalFormasPagamentoAtivas,
        // Últimos registros
        public readonly array $ultimosUsuarios,
        public readonly array $ultimosProdutos,
    ) {}

    public function toArray(): array
    {
        return [
            'totalUsuarios' => $this->totalUsuarios,
            'totalUsuariosAtivos' => $this->totalUsuariosAtivos,
            'totalUsuariosInativos' => $this->totalUsuariosInativos,
            'totalUsuariosDeletados' => $this->totalUsuariosDeletados,
            'totalCategorias' => $this->totalCategorias,
            'totalCategoriasAtivas' => $this->totalCategoriasAtivas,
            'totalProdutos' => $this->totalProdutos,
            'totalProdutosAtivos' => $this->totalProdutosAtivos,
            'totalProdutosInativos' => $this->totalProdutosInativos,
            'totalProdutosDestaque' => $this->totalProdutosDestaque,
            'totalEntregadores' => $this->totalEntregadores,
            'totalEntregadoresDisponiveis' => $this->totalEntregadoresDisponiveis,
            'totalEntregadoresOcupados' => $this->totalEntregadoresOcupados,
            'totalBairros' => $this->totalBairros,
            'totalBairrosAtivos' => $this->totalBairrosAtivos,
            'totalFormasPagamento' => $this->totalFormasPagamento,
            'totalFormasPagamentoAtivas' => $this->totalFormasPagamentoAtivas,
            'ultimosUsuarios' => $this->ultimosUsuarios,
            'ultimosProdutos' => $this->ultimosProdutos,
        ];
    }
}
