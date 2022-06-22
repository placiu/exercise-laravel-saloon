<?php

namespace App\Console\Commands\GitHub;

use App\Http\Integrations\GitHub\DataTransferObjects\Repository;
use App\Http\Integrations\GitHub\Requests\ListRepositoriesRequest;
use Illuminate\Console\Command;

class ListRepositories extends Command
{
    protected $signature = 'github:repositories {username}';

    protected $description = 'Fetch a list of user repositories from Github by the username';

    public function handle()
    {
        $username = $this->argument('username');

        $request = new ListRepositoriesRequest(username: $username);
        $request->withTokenAuth(token: (string) config('services.github.token'));

        $this->info(string: "Fetching repositories for {$username}");

        $response = $request->send();

        if ($response->failed()) {
            throw $response->toException();
        }

        $this->table(
            headers: ['ID', 'NAME', 'FULL NAME', 'URL'],
            rows: $response
                ->dto()
                ->map(fn (Repository $repository) => $repository->toArray())->toArray(),
        );

        return self::SUCCESS;
    }
}
