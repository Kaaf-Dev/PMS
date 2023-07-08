<?php

namespace App\Http\Livewire\Maintenance\Dashboard;

use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Stats extends Component
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

        $tickets_count = ($this->ready_to_load)
            ? Auth::user()->tickets()->opened()->count()
            : '';
        \Debugbar::info(Auth::user()->tickets()->opened()->toSql());
        return view('livewire.maintenance.dashboard.stats',[
            'contracts_count' => $contracts_count,
            'invoices_amount' => $invoices_amount,
            'tickets_count' => $tickets_count,
        ]);
    }
}
