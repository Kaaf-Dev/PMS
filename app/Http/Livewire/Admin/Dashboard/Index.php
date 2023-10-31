<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.index')
            ->layout('layouts.admin.app');
    }

    public function payInvoice()
    {
        $this->emit('show-admin-receipt-create-modal');
    }

    public function createContract()
    {
        $this->emit('show-contract-new-modal');
    }
}
