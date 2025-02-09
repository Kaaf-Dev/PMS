<?php

namespace App\Http\Livewire\Admin\Receipt;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.receipt.index')->layout('layouts.admin.app');
    }
}
