<?php

namespace App\Http\Livewire\Layoutes\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppSidebarOverview extends Component
{

    public $ready_to_fetch = false;

    public function render()
    {

        $contracts_no = ($this->ready_to_fetch)
            ? Auth::User()->contracts()->count()
            : 0 ;

        $invoices_total = ($this->ready_to_fetch)
            ? Auth::User()->invoices()->unpaid()->sum('amount')
            : 0 ;

        return view('livewire.layoutes.user.app-sidebar-overview', [
            'contracts_no' => $contracts_no,
            'invoices_total' => $invoices_total
        ]);
    }

    public function fetch()
    {
        $this->ready_to_fetch = true;
    }
}
