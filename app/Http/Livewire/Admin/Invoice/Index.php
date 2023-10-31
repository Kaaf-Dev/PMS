<?php

namespace App\Http\Livewire\Admin\Invoice;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.invoice.index')
            ->layout('layouts.admin.app');
    }
}
