<?php

namespace App\Jobs\ExcelUploadSystem;

use App\Services\RandomUsersService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateLargeUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    protected int $numberOfUsers;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $numberOfUsers)
    {
        $this->numberOfUsers = $numberOfUsers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        RandomUsersService::make($this->numberOfUsers);
    }
}
