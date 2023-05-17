<?php

namespace App\Http\Livewire\User\Dashboard;

use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoicesList extends Component
{
    use WithLazyLoad;

    public function render()
    {
        $invoices = ($this->ready_to_load)
            ? Auth::user()->invoices()->limit(4)->get()
            : [];
        return view('livewire.user.dashboard.invoices-list', [
            'invoices' => $invoices,
        ]);
    }
}
