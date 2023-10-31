<?php

namespace App\Http\Livewire\Admin\Property\Details;

use App\Models\Property;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Overview extends Component
{
    public $property_id;

    public function getPropertyProperty()
    {
        return Property::whereId($this->property_id)
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
        ];
    }

    public function mount($property_id)
    {
        $this->property_id = $property_id;
    }

    public function render()
    {
        return view('livewire.admin.property.details.overview');
    }

    public function getOpenTicketsProperty()
    {
        return Ticket::where('property_id', '=', $this->property_id)
            ->opened()
            ->count();
    }

}
