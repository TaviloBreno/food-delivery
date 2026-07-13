<?php

declare(strict_types=1);

namespace App\DTOs;

class ConfiguracaoDTO
{
    public function __construct(
        public readonly string $cidade,
        public readonly string $endereco,
        public readonly string $telefone,
        public readonly string $horarioFuncionamento,
        public readonly string $sobre,
        public readonly string $sobreExtra,
        public readonly string $sobreFooter,
        public readonly string $enderecoCompleto,
        public readonly string $email,
        public readonly string $whatsapp,
        public readonly string $googleMapsApiKey,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cidade: $data['cidade'] ?? 'Sua Cidade',
            endereco: $data['endereco'] ?? 'Seu Endereço',
            telefone: $data['telefone'] ?? '(00) 0000-0000',
            horarioFuncionamento: $data['horario_funcionamento'] ?? '11:00 - 23:00',
            sobre: $data['sobre'] ?? 'Food Delivery - A melhor opção para pedir comida online.',
            sobreExtra: $data['sobre_extra'] ?? 'Trabalhamos com ingredientes frescos e selecionados.',
            sobreFooter: $data['sobre_footer'] ?? 'Entregamos sabor e qualidade diretamente na sua casa.',
            enderecoCompleto: $data['endereco_completo'] ?? 'Av. Paulista, 1000 - São Paulo - SP',
            email: $data['email'] ?? 'contato@fooddelivery.com',
            whatsapp: $data['whatsapp'] ?? '(00) 00000-0000',
            googleMapsApiKey: $data['google_maps_api_key'] ?? 'AIzaSyBcg5Y2D1fpGI12T8wcbtPIsyGdw-_NV1Y'
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
