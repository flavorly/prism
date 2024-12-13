<?php

declare(strict_types=1);

namespace EchoLabs\Prism\Schema;

use EchoLabs\Prism\Concerns\NullableSchema;
use EchoLabs\Prism\Contracts\Schema;

class StringSchema implements Schema
{
    use NullableSchema;

    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly bool $nullable = false,
        /** @var array<int,string|int> */
        public readonly array $enum = [],
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
                ? $this->castToNullable('string')
                : 'string',
            'enum' => $this->enum,
        ];
    }
}
