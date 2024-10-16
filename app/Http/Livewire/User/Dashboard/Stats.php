<?php

namespace App\Http\Livewire\User\Dashboard;

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

        $contracts = ($this->ready_to_load)
            ? Auth::user()->contracts()->limit(4)->get()
            : [];

        $tickets_count = ($this->ready_to_load)
            ? Auth::user()->tickets()->opened()->count()
            : '';
        \Debugbar::info(Auth::user()->tickets()->opened()->toSql());
        return view('livewire.user.dashboard.stats',[
            'contracts_count' => $contracts_count,
            'contracts' => $contracts,
            'tickets_count' => $tickets_count,
        ]);
    }
}
