<?php

namespace App\Http\Livewire\Admin\Property;

use App\Models\Property;
use Livewire\Component;

class Details extends Component
{

    public $property;

    public function mount($property_id)
    {
        $this->property = Property::findOrFail($property_id);
    }

    public function render()
    {
        return view('livewire.admin.property.details')
            ->layout('layouts.admin.app');
    }

}
