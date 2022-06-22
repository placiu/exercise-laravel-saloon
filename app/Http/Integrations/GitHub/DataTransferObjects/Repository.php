<?php

namespace App\Http\Integrations\GitHub\DataTransferObjects;

class Repository
{
    public function __construct(
        public int $id,
        public string $name,
        public string $full_name,
        public string $url,
    ) {}

    public static function fromSaloon(array $repository): static
    {
        return new static(
            id: intval(data_get($repository, 'id')),
            name: strval(data_get($repository, 'name')),
            full_name: strval(data_get($repository, 'full_name')),
            url: strval(data_get($repository, 'url')),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'url' => $this->url,
        ];
    }
}