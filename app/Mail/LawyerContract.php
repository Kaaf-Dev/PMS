<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LawyerContract extends Mailable
{
    use Queueable, SerializesModels;

    public $lawyer_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lawyer_name)
    {
        $this->lawyer_name = $lawyer_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Contract')->view('mail.lawyer-contract');
    }
}
