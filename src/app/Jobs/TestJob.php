<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function __construct()
    {
    }

    public function handle()
    {
        echo "welcome to test job." . PHP_EOL;
        echo "we will wait 50s for you." . PHP_EOL;
        exec('sleep 50');
        echo "bye." . PHP_EOL;
    }
}
