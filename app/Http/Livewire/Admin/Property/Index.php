<?php

namespace App\Http\Livewire\Admin\Property;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.property.index')
            ->layout('layouts.admin.app');
    }
}
