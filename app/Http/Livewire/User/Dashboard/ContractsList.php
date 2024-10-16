<?php

namespace App\Http\Livewire\User\Dashboard;

use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContractsList extends Component
{
    use WithLazyLoad;

    public function render()
    {
        $invoices_amount = ($this->ready_to_load)
            ? number_format(Auth::user()->invoices()->unPaid()->sum('amount'), 2)
            : '';
        return view('livewire.user.dashboard.contracts-list', [
            'invoices_amount' => $invoices_amount,
        ]);
    }
}
