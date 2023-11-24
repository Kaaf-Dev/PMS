<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserLogin extends Mailable
{
    use Queueable, SerializesModels;

    public $selected_user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($selected_user)
    {
        $this->selected_user = $selected_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('User Info Login')
            ->view('mail.user-login');
    }
}
