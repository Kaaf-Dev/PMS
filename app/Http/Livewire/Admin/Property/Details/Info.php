<?php

namespace App\Http\Livewire\Admin\Property\Details;

use App\Models\Property;
use Livewire\Component;

class Info extends Component
{
    public $property_id;

    public function getPropertyProperty()
    {
        return Property::whereId($this->property_id)
            ->withCount([
                'apartments',
                'apartments as available_apartments_count',
                'apartments as rented_apartments_count',
            ])
            ->firstOr(function () {
                abort(404);
            });
    }

    public function getListeners()
    {
        return [
            'property-updated' => '$refresh',
        ];
    }

    public function mount($property_id)
    {
        $this->property_id = $property_id;
    }

    public function render()
    {
        return view('livewire.admin.property.details.info');
    }
}
