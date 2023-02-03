<?php

namespace App\Http\Livewire\Admin\Property;

use App\Models\Property;
use Livewire\Component;

class Details extends Component
{
    public $property_id;

    public function mount($property_id)
    {
        $this->property_id = $property_id;
    }

    public function render()
    {
        return view('livewire.admin.property.details')
            ->layout('layouts.admin.app');
    }

    public function getPropertyProperty()
    {
        return Property::whereId($this->property_id)
            ->firstOr(function () {
                abort(404);
            });
    }

}
