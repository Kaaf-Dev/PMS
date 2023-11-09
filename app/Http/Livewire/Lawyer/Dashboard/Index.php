<?php

namespace App\Http\Livewire\Lawyer\Dashboard;

use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        return view('livewire.lawyer.dashboard.index')
            ->layout('layouts.lawyer.app');
    }
}
