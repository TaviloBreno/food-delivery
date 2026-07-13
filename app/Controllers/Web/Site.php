<?php

declare(strict_types=1);

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Services\ConfiguracaoService;
use App\Services\ProdutoService;
use App\Services\DashboardService;
use App\Repositories\ConfiguracaoRepository;
use App\Repositories\ProdutoRepository;
use App\Repositories\UsuarioRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\EntregadorRepository;
use App\Repositories\BairroRepository;
use App\Repositories\FormaPagamentoRepository;
use App\Models\ProdutoModel;
use App\Models\UsuarioModel;
use App\Models\CategoriaModel;
use App\Models\EntregadorModel;
use App\Models\BairroAtendidoModel;
use App\Models\FormaPagamentoModel;

class Site extends BaseController
{
    public function index(): string
    {
        // Instanciar os repositórios
        $usuarioRepository = new UsuarioRepository(new UsuarioModel());
        $categoriaRepository = new CategoriaRepository(new CategoriaModel());
        $produtoRepository = new ProdutoRepository(new ProdutoModel());
        $entregadorRepository = new EntregadorRepository(new EntregadorModel());
        $bairroRepository = new BairroRepository(new BairroAtendidoModel());
        $formaPagamentoRepository = new FormaPagamentoRepository(new FormaPagamentoModel());

        // Instanciar os serviços com suas dependências
        $configuracaoService = new ConfiguracaoService(new ConfiguracaoRepository());
        $produtoService = new ProdutoService(new ProdutoRepository(new ProdutoModel()));
        $dashboardService = new DashboardService(
            $usuarioRepository,
            $categoriaRepository,
            $produtoRepository,
            $entregadorRepository,
            $bairroRepository,
            $formaPagamentoRepository
        );

        // Dados do sistema
        $dadosConfiguracao = $configuracaoService->getDadosCompletos();

        // Dados de produtos
        $categorias = $produtoService->getCategoriasAtivas();
        $dadosProdutos = [
            'categoriasMenu' => $categorias,
            'produtosPorCategoria' => $this->normalizarProdutos($this->getProdutosPorCategoria($produtoService, $categorias)),
            'destaques' => $this->normalizarProdutos($this->getProdutosDestaque($produtoService))
        ];

        // Dados do dashboard
        $dashboardDTO = $dashboardService->getDados();
        $dadosDashboard = $dashboardDTO->toArray();

        // Dados da galeria (mock - substituir pelo GaleriaService)
        $galeria = $this->getGaleriaFotos();

        // Merge de todos os dados
        $data = array_merge(
            $dadosConfiguracao,
            $dadosProdutos,
            $dadosDashboard,
            ['galeria' => $galeria]
        );

        // Dados adicionais
        $data['titulo'] = 'Food Delivery - Butazzo Pizza';
        $data['usuario_nome'] = session('usuario_nome') ?? 'Visitante';
        $data['isLoggedIn'] = session('isLoggedIn') ?? false;

        return view('Web/home/index', $data);
    }

    public function busca(): string
    {
        $termo = $this->request->getGet('q') ?? '';

        if (empty($termo)) {
            return redirect()->to('/');
        }

        $produtoService = new ProdutoService(new ProdutoRepository(new ProdutoModel()));
        $produtos = $produtoService->procurar($termo);

        return view('Web/home/busca', [
            'produtos' => $produtos,
            'termo' => $termo,
            'titulo' => 'Resultados para: ' . $termo
        ]);
    }

    /**
     * Obtém produtos por categoria
     */
    private function getProdutosPorCategoria($produtoService, array $categorias): array
    {
        $produtosPorCategoria = [];

        foreach ($categorias as $categoria) {
            $resultado = $produtoService->listar(10, null);
            $produtos = $resultado['produtos'] ?? [];

            $produtosFiltrados = array_filter($produtos, function ($p) use ($categoria) {
                return isset($p->categoria_id) && $p->categoria_id == $categoria->id && $p->ativo == 1;
            });

            $produtosPorCategoria[$categoria->id] = array_slice($produtosFiltrados, 0, 6);
        }

        return $produtosPorCategoria;
    }

    /**
     * Obtém produtos em destaque
     */
    private function getProdutosDestaque($produtoService): array
    {
        $resultado = $produtoService->listar(10, null);
        $produtos = $resultado['produtos'] ?? [];

        $destaques = array_filter($produtos, function ($p) {
            return isset($p->destaque) && $p->destaque == 1 && $p->ativo == 1;
        });

        return array_slice($destaques, 0, 5);
    }

    /**
     * Normaliza produtos para usar imagens reais do banco ou fallback local
     */
    private function normalizarProdutos(array $produtos): array
    {
        foreach ($produtos as $produto) {
            if (is_object($produto)) {
                $produto->imagem_url = $this->resolverImagemUrl($produto->imagem ?? null);
            }
        }

        return $produtos;
    }

    private function resolverImagemUrl(?string $imagem): string
    {
        if (empty($imagem)) {
            return base_url('web/src/assets/img/photos/food-1.jpg');
        }

        if (filter_var($imagem, FILTER_VALIDATE_URL)) {
            return $imagem;
        }

        $caminhoLocal = FCPATH . 'web/src/assets/img/photos/' . ltrim($imagem, '/');

        if (is_file($caminhoLocal)) {
            return base_url('web/src/assets/img/photos/' . ltrim($imagem, '/'));
        }

        return base_url('web/src/assets/img/photos/food-1.jpg');
    }

    /**
     * Mock de fotos da galeria - substituir pelo GaleriaService
     */
    private function getGaleriaFotos(): array
    {
        return [
            'gallery-1.jpg',
            'gallery-2.jpg',
            'gallery-3.jpg',
            'gallery-4.jpg',
            'gallery-5.jpg',
            'gallery-6.jpg',
            'gallery-7.jpg',
            'gallery-8.jpg'
        ];
    }
}
