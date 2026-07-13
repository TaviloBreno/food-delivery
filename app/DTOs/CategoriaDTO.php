<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\StatusCategoria;

class CategoriaDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $nome,
        public readonly string $slug,
        public readonly ?string $descricao,
        public readonly ?string $icone,
        public readonly StatusCategoria $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            nome: $data['nome'],
            slug: $data['slug'] ?? '',
            descricao: $data['descricao'] ?? null,
            icone: $data['icone'] ?? null,
            status: StatusCategoria::tryFrom((int) ($data['ativo'] ?? 1)) ?? StatusCategoria::ATIVO,
        );
    }

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'slug' => $this->slug,
            'descricao' => $this->descricao,
            'icone' => $this->icone,
            'ativo' => $this->status->value,
        ];
    }

    public function toArrayWithId(): array
    {
        return array_merge(
            $this->toArray(),
            ['id' => $this->id]
        );
    }
}
