<?php

namespace App\Jobs;

use App\Models\UserProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoupdateProviders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users_providers = UserProvider::where('autoupdate', 1)->get();

        foreach ($users_providers as $userProvider) {
            UpdateProviderJob::dispatch($userProvider);
        }
    }
}
