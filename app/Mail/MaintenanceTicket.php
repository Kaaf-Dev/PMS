<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaintenanceTicket extends Mailable
{
    use Queueable, SerializesModels;

    public $selected_company;
    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->ticket = $data['ticket'];
        $this->selected_company = $data['company'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Maintenance Request' . $this->ticket->no)->view('mail.maintenance-ticket');
    }
}
