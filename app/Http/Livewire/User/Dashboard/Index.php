<?php

namespace App\Http\Livewire\User\Dashboard;

use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    use WithLazyLoad;

    public function render()
    {
        $contracts_count = ($this->ready_to_load)
            ? Auth::user()->contracts()->count()
            : '';

        $invoices_amount = ($this->ready_to_load)
            ? number_format(Auth::user()->invoices()->unPaid()->sum('amount'), 2)
            : '';

        $maintenance_requests_count = ($this->ready_to_load)
            ? 0
            : '';

        return view('livewire.user.dashboard.index', [
            'contracts_count' => $contracts_count,
            'invoices_amount' => $invoices_amount,
            'maintenance_requests_count' => $maintenance_requests_count,
        ])->layout('layouts.user.app');
    }
}
