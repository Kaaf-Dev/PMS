<?php

namespace App\Http\Livewire\Admin\Property\Apartment;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.property.apartment.index')
            ->layout('layouts.admin.app');

    }
}
