<?php

namespace App\Http\Livewire\User\Ticket;

use Livewire\Component;

class Index extends Component
{

    public $contract_id;

    public function mount($contract_id = null)
    {
        if ($contract_id) {
            $this->contract_id = $contract_id;
        }
    }

    public function render()
    {
        return view('livewire.user.ticket.index')
            ->layout('layouts.user.app');
    }

    public function newTicket()
    {
        $params = [];

        if ($this->contract_id) {
            $params = ['contract_id' => $this->contract_id];
        }

        return $this->emit('show-user-ticket-create-modal', $params);
    }
}
