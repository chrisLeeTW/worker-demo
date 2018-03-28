<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\TestJob;

class AddTestJob extends Command
{
    use DispatchesJobs;

    protected $signature = 'test:add_test_job';
    protected $description = 'add test job';

    public function handle()
    {
        $job = (new TestJob())->onQueue('redis');
        $this->dispatch($job);
    }
}
