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
        $contracts = ($this->ready_to_load)
            ? Auth::user()->contracts
            : [];
        return view('livewire.user.dashboard.contracts-list', [
            'contracts' => $contracts,
        ]);
    }
}
