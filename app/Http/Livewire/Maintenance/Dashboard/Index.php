<?php

namespace App\Http\Livewire\Maintenance\Dashboard;

use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        return view('livewire.maintenance.dashboard.index')
            ->layout('layouts.maintenance.app');
    }
}
