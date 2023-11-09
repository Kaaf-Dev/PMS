<?php

namespace App\Http\Livewire\Maintenance\Dashboard;

use App\Models\Ticket;
use App\Traits\WithLazyLoad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Stats extends Component
{
    use WithLazyLoad;

    public function render()
    {
        $tickets_new_count = ($this->ready_to_load)
            ? Auth::user()->tickets()->where('status', '=', Ticket::STATUS_NEW)->count()
            : '';

        $tickets_under_processing_count = ($this->ready_to_load)
            ? Auth::user()->tickets()->where('status', '=', Ticket::STATUS_UNDER_PROCESSING)->count()
            : '';

        $tickets_completed_count = ($this->ready_to_load)
            ? Auth::user()->tickets()->where('status', '=', Ticket::STATUS_COMPLETE)->count()
            : '';

        return view('livewire.maintenance.dashboard.stats',[
            'tickets_new_count' => $tickets_new_count,
            'tickets_under_processing_count' => $tickets_under_processing_count,
            'tickets_completed_count' => $tickets_completed_count,
        ]);
    }
}
