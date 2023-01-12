<?php

namespace App\Jobs;

use App\Mail\StudentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $testList = [];
    /**
     * Create a new job instance.
     *
     * @param Array $testList student's email,name and code
     * @return void
     */
    public function __construct(array $testList)
    {
        $this->testList = $testList;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->testList as $sl) {
            Mail::to($sl["email"])
                ->send(new StudentMail($sl));
        }
    }
}
