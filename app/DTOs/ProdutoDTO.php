<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\StatusProduto;

class ProdutoDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $categoriaId,
        public readonly string $nome,
        public readonly string $slug,
        public readonly ?string $descricao,
        public readonly float $preco,
        public readonly ?float $precoPromocional,
        public readonly ?string $imagem,
        public readonly StatusProduto $status,
        public readonly bool $destaque,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            categoriaId: (int) $data['categoria_id'],
            nome: $data['nome'],
            slug: $data['slug'] ?? '',
            descricao: $data['descricao'] ?? null,
            preco: (float) str_replace(',', '.', $data['preco']),
            precoPromocional: !empty($data['preco_promocional']) ? (float) str_replace(',', '.', $data['preco_promocional']) : null,
            imagem: $data['imagem'] ?? null,
            status: StatusProduto::tryFrom((int) ($data['ativo'] ?? 1)) ?? StatusProduto::ATIVO,
            destaque: (bool) ($data['destaque'] ?? 0),
        );
    }

    public function toArray(): array
    {
        return [
            'categoria_id' => $this->categoriaId,
            'nome' => $this->nome,
            'slug' => $this->slug,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'preco_promocional' => $this->precoPromocional,
            'imagem' => $this->imagem,
            'ativo' => $this->status->value,
            'destaque' => $this->destaque ? 1 : 0,
        ];
    }
}
