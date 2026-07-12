<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\CategoriaModel;
use App\Models\ProdutoModel;
use App\Models\EntregadorModel;
use App\Models\BairroAtendidoModel;
use App\Models\FormaPagamentoModel;

class Dashboard extends BaseController
{
    private UsuarioModel $usuarioModel;
    private CategoriaModel $categoriaModel;
    private ProdutoModel $produtoModel;
    private EntregadorModel $entregadorModel;
    private BairroAtendidoModel $bairroModel;
    private FormaPagamentoModel $formaPagamentoModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->categoriaModel = new CategoriaModel();
        $this->produtoModel = new ProdutoModel();
        $this->entregadorModel = new EntregadorModel();
        $this->bairroModel = new BairroAtendidoModel();
        $this->formaPagamentoModel = new FormaPagamentoModel();
    }

    public function index()
    {
        // 🔥 USUÁRIOS
        $totalUsuarios = $this->usuarioModel->countAllResults();
        $totalUsuariosAtivos = $this->usuarioModel->where('ativo', 1)->countAllResults();
        $totalUsuariosInativos = $this->usuarioModel->where('ativo', 0)->countAllResults();
        $totalUsuariosDeletados = $this->usuarioModel->withDeleted()->where('deletado_em IS NOT NULL')->countAllResults();

        // 🔥 CATEGORIAS
        $totalCategorias = $this->categoriaModel->countAllResults();
        $totalCategoriasAtivas = $this->categoriaModel->where('ativo', 1)->countAllResults();

        // 🔥 PRODUTOS
        $totalProdutos = $this->produtoModel->countAllResults();
        $totalProdutosAtivos = $this->produtoModel->where('ativo', 1)->countAllResults();
        $totalProdutosInativos = $this->produtoModel->where('ativo', 0)->countAllResults();
        $totalProdutosDestaque = $this->produtoModel->where('destaque', 1)->where('ativo', 1)->countAllResults();

        // 🔥 ENTREGADORES
        $totalEntregadores = $this->entregadorModel->countAllResults();
        $totalEntregadoresDisponiveis = $this->entregadorModel->where('disponivel', 1)->where('ativo', 1)->countAllResults();
        $totalEntregadoresOcupados = $this->entregadorModel->where('disponivel', 0)->where('ativo', 1)->countAllResults();

        // 🔥 BAIRROS ATENDIDOS
        $totalBairros = $this->bairroModel->countAllResults();
        $totalBairrosAtivos = $this->bairroModel->where('ativo', 1)->countAllResults();

        // 🔥 FORMAS DE PAGAMENTO
        $totalFormasPagamento = $this->formaPagamentoModel->countAllResults();
        $totalFormasPagamentoAtivas = $this->formaPagamentoModel->where('ativo', 1)->countAllResults();

        // 🔥 ÚLTIMOS REGISTROS
        $ultimosUsuarios = $this->usuarioModel->orderBy('id', 'DESC')->findAll(5);
        $ultimosProdutos = $this->produtoModel->select('produtos.*, categorias.nome as categoria_nome')
            ->join('categorias', 'categorias.id = produtos.categoria_id')
            ->orderBy('produtos.id', 'DESC')
            ->findAll(5);

        $data = [
            'titulo' => 'Dashboard',
            // Usuários
            'totalUsuarios' => $totalUsuarios,
            'totalUsuariosAtivos' => $totalUsuariosAtivos,
            'totalUsuariosInativos' => $totalUsuariosInativos,
            'totalUsuariosDeletados' => $totalUsuariosDeletados,
            // Categorias
            'totalCategorias' => $totalCategorias,
            'totalCategoriasAtivas' => $totalCategoriasAtivas,
            // Produtos
            'totalProdutos' => $totalProdutos,
            'totalProdutosAtivos' => $totalProdutosAtivos,
            'totalProdutosInativos' => $totalProdutosInativos,
            'totalProdutosDestaque' => $totalProdutosDestaque,
            // Entregadores
            'totalEntregadores' => $totalEntregadores,
            'totalEntregadoresDisponiveis' => $totalEntregadoresDisponiveis,
            'totalEntregadoresOcupados' => $totalEntregadoresOcupados,
            // Bairros
            'totalBairros' => $totalBairros,
            'totalBairrosAtivos' => $totalBairrosAtivos,
            // Formas de Pagamento
            'totalFormasPagamento' => $totalFormasPagamento,
            'totalFormasPagamentoAtivas' => $totalFormasPagamentoAtivas,
            // Últimos registros
            'ultimosUsuarios' => $ultimosUsuarios,
            'ultimosProdutos' => $ultimosProdutos,
        ];

        return view('Admin/Dashboard/index', $data);
    }
}
