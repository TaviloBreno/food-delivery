<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\DashboardDTO;
use App\Interfaces\{
    DashboardServiceInterface,
    UsuarioRepositoryInterface,
    CategoriaRepositoryInterface,
    ProdutoRepositoryInterface,
    EntregadorRepositoryInterface,
    BairroRepositoryInterface,
    FormaPagamentoRepositoryInterface
};

class DashboardService implements DashboardServiceInterface
{
    public function __construct(
        private readonly UsuarioRepositoryInterface $usuarioRepository,
        private readonly CategoriaRepositoryInterface $categoriaRepository,
        private readonly ProdutoRepositoryInterface $produtoRepository,
        private readonly EntregadorRepositoryInterface $entregadorRepository,
        private readonly BairroRepositoryInterface $bairroRepository,
        private readonly FormaPagamentoRepositoryInterface $formaPagamentoRepository,
    ) {}

    public function getDados(): DashboardDTO
    {
        return new DashboardDTO(
            // Usuários
            totalUsuarios: $this->usuarioRepository->countAll(),
            totalUsuariosAtivos: $this->usuarioRepository->countWhere(['ativo' => 1]),
            totalUsuariosInativos: $this->usuarioRepository->countWhere(['ativo' => 0]),
            totalUsuariosDeletados: $this->contarUsuariosDeletados(),
            // Categorias
            totalCategorias: $this->categoriaRepository->countAll(),
            totalCategoriasAtivas: $this->categoriaRepository->countAtivas(),
            // Produtos
            totalProdutos: $this->produtoRepository->countAll(),
            totalProdutosAtivos: $this->produtoRepository->countAtivos(),
            totalProdutosInativos: $this->produtoRepository->countInativos(),
            totalProdutosDestaque: $this->produtoRepository->countDestaques(),
            // Entregadores
            totalEntregadores: $this->entregadorRepository->countAll(),
            totalEntregadoresDisponiveis: $this->entregadorRepository->countDisponiveis(),
            totalEntregadoresOcupados: $this->entregadorRepository->countOcupados(),
            // Bairros
            totalBairros: $this->bairroRepository->countAll(),
            totalBairrosAtivos: $this->bairroRepository->countAtivos(),
            // Formas de Pagamento
            totalFormasPagamento: $this->formaPagamentoRepository->countAll(),
            totalFormasPagamentoAtivas: $this->formaPagamentoRepository->countAtivas(),
            // Últimos registros
            ultimosUsuarios: $this->usuarioRepository->getLatest(5),
            ultimosProdutos: $this->produtoRepository->getUltimosComCategoria(5),
        );
    }

    private function contarUsuariosDeletados(): int
    {
        return $this->usuarioRepository->countDeletados();
    }
}
