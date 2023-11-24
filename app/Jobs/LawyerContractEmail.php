<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class LawyerContractEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $selected_lawyer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($selected_lawyer)
    {
        $this->selected_lawyer = $selected_lawyer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->selected_lawyer->email)->send(new \App\Mail\LawyerContract($this->selected_lawyer->name));

    }
}
