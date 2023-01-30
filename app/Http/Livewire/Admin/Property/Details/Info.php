<?php

namespace App\Http\Livewire\Admin\Property\Details;

use Livewire\Component;

class Info extends Component
{
    public $property;

    public function mount($property)
    {
        $this->fill([
            'property' => $property,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.property.details.info');
    }
}
