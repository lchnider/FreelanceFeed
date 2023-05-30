<?php

namespace App\Console\Commands\Test;

use App\Jobs\UpdateProviderJob;
use App\Models\UserProvider;
use App\Models\Work;
use Illuminate\Console\Command;

class UpdateUserProviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-updateUserProviders {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userProviders = UserProvider::where('user_id', $this->argument('userId'))->get();
        foreach ($userProviders as $userProvider) {
            UpdateProviderJob::dispatch($userProvider);
        }
    }
}
