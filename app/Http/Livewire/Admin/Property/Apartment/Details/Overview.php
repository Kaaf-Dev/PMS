<?php

namespace App\Http\Livewire\Admin\Property\Apartment\Details;

use App\Models\Apartment;
use Livewire\Component;

class Overview extends Component
{
    public $apartment_id;

    public function getApartmentProperty()
    {
        return Apartment::whereId($this->apartment_id)
            ->firstOr(function () {
                abort(404);
            });
    }

    public function getListeners()
    {
        return [
            'apartment-updated' => '$refresh',
        ];
    }

    public function mount($apartment_id)
    {
        $this->apartment_id = $apartment_id;
    }

    public function render()
    {
        return view('livewire.admin.property.apartment.details.overview');
    }

    public function showContractNewModal()
    {
        $this->emit('show-contract-new-modal', [
            'property_id' => $this->apartment->Property->id,
            'apartment_id' => $this->apartment->id,
        ]);
    }
}
