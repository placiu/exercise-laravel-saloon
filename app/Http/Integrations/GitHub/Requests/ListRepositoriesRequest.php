<?php

namespace App\Http\Integrations\GitHub\Requests;

use App\Http\Integrations\GitHub\GitHubConnector;
use App\Http\Integrations\GitHub\DataTransferObjects\Repository;
use Illuminate\Support\Collection;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class ListRepositoriesRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $connector = GitHubConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function defineEndpoint(): string
    {
        return "/users/{$this->username}/repos";
    }

    protected function castToDto(SaloonResponse $response): Collection
    {
        return (new Collection(items: $response->json()))
            ->map(function ($repository): Repository {
                return Repository::fromSaloon(repository: $repository);
            });
    }
}
