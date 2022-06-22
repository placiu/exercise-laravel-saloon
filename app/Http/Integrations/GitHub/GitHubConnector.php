<?php

namespace App\Http\Integrations\GitHub;

use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;

class GitHubConnector extends SaloonConnector
{
    use AcceptsJson;

    public function defineBaseUrl(): string
    {
        return (string) config('services.github.url');
    }

    public function defaultHeaders(): array
    {
        return [];
    }

    public function defaultConfig(): array
    {
        return [
            'timeout' => 30,
        ];
    }
}
