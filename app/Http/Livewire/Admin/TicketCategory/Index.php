<?php

namespace App\Http\Livewire\Admin\TicketCategory;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.ticket-category.index')
            ->layout('layouts.admin.app');
    }
}
