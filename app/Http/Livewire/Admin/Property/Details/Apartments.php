<?php

namespace App\Http\Livewire\Admin\Property\Details;

use App\Models\Apartment;
use App\Models\Property;
use Livewire\Component;

class Apartments extends Component
{
    public $property_id;

    public function getPropertyProperty()
    {
        return Property::whereId($this->property_id)
            ->with('apartments')
            ->withCount([
                'apartments',
            ])
            ->firstOr(function () {
                abort(404);
            });
    }

    public function getListeners()
    {
        return [
            'property-updated' => '$refresh',
            'apartment-added' => '$refresh',
        ];
    }

    public function mount($property_id)
    {
        $this->property_id = $property_id;
    }

    public function render()
    {
        return view('livewire.admin.property.details.apartments');
    }

    public function showApartmentAddModal()
    {
        $this->emit('show-apartment-add-modal', [
            'property_id' => $this->property_id,
        ]);
    }

    public function copyApartment($apartment_id)
    {
        $apartment = Apartment::findOrFail($apartment_id)->toArray();
        $this->emit('show-apartment-add-modal', $apartment);
    }
}
