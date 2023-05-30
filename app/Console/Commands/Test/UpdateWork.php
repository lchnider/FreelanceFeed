<?php

namespace App\Console\Commands\Test;

use App\Models\Work;
use Illuminate\Console\Command;

class UpdateWork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-work';

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
        $work = Work::first();
        $work->title = "ee";
        $work->description = "ee";
        $work->save();
    }
}
