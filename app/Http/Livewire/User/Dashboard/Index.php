<?php

namespace App\Http\Livewire\User\Dashboard;

use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        return view('livewire.user.dashboard.index')
            ->layout('layouts.user.app');
    }
}
