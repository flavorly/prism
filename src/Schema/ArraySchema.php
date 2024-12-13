<?php

declare(strict_types=1);

namespace EchoLabs\Prism\Schema;

use EchoLabs\Prism\Concerns\NullableSchema;
use EchoLabs\Prism\Contracts\Schema;

class ArraySchema implements Schema
{
    use NullableSchema;

    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly Schema $items,
        public readonly bool $nullable = false,
        public readonly ?int $max_items = null,
        public readonly ?int $min_items = null,
    ) {}

    #[\Override]
    public function name(): string
    {
        return $this->name;
    }

    #[\Override]
    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'type' => $this->nullable
                ? $this->castToNullable('array')
                : 'array',
            'items' => $this->items->toArray(),
            ...$this->max_items ? ['maxItems' => $this->max_items] : [],
            ...$this->min_items ? ['minItems' => $this->min_items] : [],
        ];
    }
}
