<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public $type;

    public function render()
    {
        return view('livewire.admin.dashboard.index')
            ->layout('layouts.admin.app');
    }

    public function changeDashboard($type = null)
    {
        $this->type = $type;
        $this->emit('changeDashboardType', $this->type);
    }
}
