<?php

namespace App\Jobs;

use App\Models\UserProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateProviderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userProvider;

    /**
     * Create a new job instance.
     *
     * @param  Provider  $provider
     * @return void
     */
    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $provider = $this->userProvider->provider;
        $url = $provider->url . "/{$this->userProvider->param}";
        Log::info($url);
    }
}
