<?php

namespace App\Http\Livewire\Admin\Property\Details;

use App\Models\Property;
use Livewire\Component;

class Files extends Component
{
    public $property;

    public function getListeners()
    {
        return [
            'refreshPropertyFileTable' => '$refresh',
        ];
    }

    public function mount(Property $property_id)
    {
        $this->property = $property_id;
    }

    public function render()
    {
        return view('livewire.admin.property.details.files');
    }

    public function showAddPropertyFileModal()
    {
        $this->emit('show-add-property-file-modal', $this->property->id);
    }

    public function deleteFile($file_id)
    {
        $this->emit('show-delete-property-file-modal', $file_id);
    }

}
