<?php

namespace App\Http\Livewire\Admin\Property\Apartment;

use App\Models\Apartment;
use Livewire\Component;

class Details extends Component
{
    public $property_id;
    public $apartment_id;

    public function mount($property_id, $apartment_id)
    {
        $this->property_id = $property_id;
        $this->apartment_id = $apartment_id;
    }

    public function render()
    {
        return view('livewire.admin.property.apartment.details')
            ->layout('layouts.admin.app');
    }

    public function getApartmentProperty()
    {
        return Apartment::whereId($this->apartment_id)
            ->where('property_id', '=', $this->property_id)
            ->firstOr(function () {
                abort(404);
            });
    }

}
